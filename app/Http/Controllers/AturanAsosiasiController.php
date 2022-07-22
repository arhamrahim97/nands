<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Rule;
use App\Models\Dataset;
use App\Models\Riwayat;
use App\Models\LiftRatio;
use App\Models\FrequentItem;
use Illuminate\Http\Request;
use App\Models\DataTransaksi;
use App\Models\AturanAsosiasi;
// use App\Models\SupportItemset;
use App\Models\FrequentItemset;
use GuzzleHttp\Promise\Create;
use PhpParser\Node\Stmt\Break_;
use App\Models\ConfidenceItemset;
use App\Models\Confidence_Itemset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ConditionalPatternBase;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Schema\Blueprint;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

use function PHPSTORM_META\map;

class AturanAsosiasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dariTanggal = DataTransaksi::orderBy('tanggal', 'ASC')->pluck('tanggal')->first();
        $sampaiTanggal = DataTransaksi::orderBy('tanggal', 'DESC')->pluck('tanggal')->first();
        $riwayatTerakhir = Riwayat::orderBy('id', 'DESC')->first();


        $if = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('if')->toArray();
        $then = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('then')->toArray();
        $support = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('support_count')->toArray();
        $confidence = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('confidence_persen')->toArray();
        $liftRatio = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('lift_ratio')->toArray();
        $ifJSON = json_encode($if);
        $thenJSON = json_encode($then);
        $supportJSON = json_encode($support);
        $confidenceJSON = json_encode($confidence);
        $liftRatioJSON = json_encode($liftRatio);
        $data = [
            'title' => 'Aturan Asosiasi',
            'dariTanggal' => Carbon::parse($dariTanggal)->format('d/m/Y'),
            'sampaiTanggal' => Carbon::parse($sampaiTanggal)->format('d/m/Y'),
            'riwayatTerakhir' => $riwayatTerakhir,
            'if' => $ifJSON,
            'then' => $thenJSON,
            'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            'liftRatio' => $liftRatioJSON,
        ];

        return view('aturan_asosiasi', $data);
    }

    public function prosesAturanAsosiasi(Request $request)
    {
        $start = microtime(true);
        $input = [
            'minimum_support' => $request->minimum_support,
            'minimum_confidence' => $request->minimum_confidence,
            'dari_tanggal' => DateTime::createFromFormat('d/m/Y', $request->dari_tanggal)->format('Y-m-d'),
            'sampai_tanggal' => DateTime::createFromFormat('d/m/Y', $request->sampai_tanggal)->format('Y-m-d'),
        ];

        $riwayat = Riwayat::create($input);

        $dataTransaksiImpor = DataTransaksi::all();

        $dataSet = $this->preProcessing($riwayat, $dataTransaksiImpor); // Membuat temporary tabel berdasarkan hasil prePocessing

        $countDataSet = count($dataSet); // Jumlah Data Set

        Riwayat::where('id', $riwayat->id)->update(['jumlah_dataset' => $countDataSet]); // update jumlah dataset setelah preprocessing

        $frequentItem = $this->frequentItem($dataSet, $riwayat); // Menghitung frekuensi tiap barang

        if ($frequentItem->get()->count() == 0) {
            Riwayat::where('id', $riwayat->id)->delete();
            return Response()->json([
                'message' => 'supportTinggi'
            ]);
        }

        $dataSetPriority = $this->dataSetPriority($frequentItem, $dataSet, $riwayat, $start); // Mengurutkan berdasarkan priority tiap barang

        $conditionalPatternBase = $this->conditionalPatternBase($dataSetPriority, $riwayat, $frequentItem); // Menghitung conditional pattern base

        $frequentItemset = $this->frequentItemset($conditionalPatternBase, $riwayat, $countDataSet); // Menghitung itemset

        if ($frequentItemset->get()->count() == 0) {
            Riwayat::where('id', $riwayat->id)->delete();
            return Response()->json([
                'message' => 'supportTinggi',
                'ket' => 'itemset',
            ]);
        }

        $confidenceItemset = $this->confidenceItemset($frequentItemset, $riwayat);

        if ($confidenceItemset->get()->count() == 0) {
            Riwayat::where('id', $riwayat->id)->delete();
            return Response()->json([
                'message' => 'confidenceTinggi',
            ]);
        }

        $liftRatio = $this->liftRatio($confidenceItemset, $riwayat, $countDataSet);

        $rule = $this->rule($liftRatio, $riwayat);

        $end_time = microtime(true);
        $execution_time = round((($end_time - $start) / 60), 2);
        Riwayat::where('id', $riwayat->id)->update(['lama_proses' => $execution_time]);

        return Response()->json(['message' => 'success', 'time' => $execution_time]);
    }

    public function preProcessing($riwayat, $dataTransaksiImpor)
    {
        // Copy data transaksi ke dataset
        DB::statement('INSERT INTO `dataset` (tanggal, id_transaksi, nama_barang) SELECT tanggal, id_transaksi, nama_barang FROM `data_transaksi`');

        // update dataset where riwayat_id = 0
        Dataset::where('riwayat_id', 0)->update(['riwayat_id' => $riwayat->id]);

        // Delete transaksi of item == 1
        DB::statement(DB::raw("DELETE FROM `dataset` WHERE id_transaksi IN (select id_transaksi from (select id_transaksi from dataset group by id_transaksi having count(*) <2 ) t );"));

        // Delete Between Date
        DB::statement(DB::raw("DELETE FROM `dataset` WHERE riwayat_id = " . $riwayat->id . " AND tanggal NOT BETWEEN '" . $riwayat['dari_tanggal'] . "' AND '" . $riwayat['sampai_tanggal'] . "'"));

        // Result Dataset
        $dataSet = Dataset::select('riwayat_id', 'id_transaksi', DB::raw('GROUP_CONCAT(nama_barang SEPARATOR "|") as nama_barang'), DB::raw("date_format(tanggal,'%d/%m/%Y') as tanggal"))->where('riwayat_id', $riwayat->id)->groupBy('riwayat_id')->groupBy('id_transaksi')->groupBy('tanggal')->get();
        return $dataSet;
    }

    public function frequentItem($dataSet, $riwayat)
    {
        $countPerItem = Dataset::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))
            ->where('riwayat_id', $riwayat->id)
            ->groupBy('nama_barang')
            ->get();
     
        $tempFrequentItem = [];
        $i = 'A';
        foreach ($countPerItem as $row) {
            while ($i < 'ZZZZZZZZZZZZ') {
                $data = [
                    'riwayat_id' => $riwayat->id,
                    'inisialisasi' => $i,
                    'nama_barang' => $row->nama_barang,
                    'support_count' => $row->jumlah,
                    'support' => $row->jumlah / count($dataSet),
                ];
                if ($data['support_count'] >= $riwayat->minimum_support) {
                    array_push($tempFrequentItem, $data);
                }
                break;
            }
            $i++;
        }

        $sort = collect($tempFrequentItem)->sortBy('inisialisasi')->sortByDesc('support_count')->toArray();

        FrequentItem::insert($sort);
        $frequentItem = FrequentItem::where('riwayat_id', $riwayat->id);
        return $frequentItem;
    }

    public function dataSetPriority($frequentItem, $dataSet, $riwayat, $start)
    {
        $namaBarang = $frequentItem->pluck('nama_barang');
        $namaBarangToString = implode('","', collect($namaBarang)->toArray());
        DB::statement('DELETE FROM `dataset` WHERE riwayat_id = ' . $riwayat->id . ' AND nama_barang NOT IN ("' . $namaBarangToString . '")');
        $tempData1 = [];
        $tempData2 = [];
        $tempData3 = [];
        $tempData4 = [];
        $tempData5 = [];
        $tempData6 = [];
        $tempData7 = [];
        $tempData8 = [];
        $tempData9 = [];
        $tempData10 = [];
        $iteration = 1;
        foreach ($dataSet as $row) {
            $namaBarangArr = explode('|', $row->nama_barang);
            $listBarang = FrequentItem::where('riwayat_id', $riwayat->id)->whereIn('nama_barang', $namaBarangArr)->orderBy('support_count', 'DESC')->orderBy('inisialisasi', 'ASC')->pluck('inisialisasi')->implode(',');
            // dd($namaBarangArr);
            $data = [
                'riwayat_id' => $riwayat->id,
                'tanggal' => DateTime::createFromFormat('d/m/Y', $row->tanggal)->format('Y-m-d'),
                'id_transaksi' => $row->id_transaksi,
                'nama_barang' => $listBarang,
            ];
            if ($iteration <= 5000) {
                array_push($tempData1, $data);
            } elseif ($iteration <= 10000) {
                array_push($tempData2, $data);
            } elseif ($iteration <= 15000) {
                array_push($tempData3, $data);
            } elseif ($iteration <= 20000) {
                array_push($tempData4, $data);
            } elseif ($iteration <= 25000) {
                array_push($tempData5, $data);
            } elseif ($iteration <= 30000) {
                array_push($tempData6, $data);
            } elseif ($iteration <= 35000) {
                array_push($tempData7, $data);
            } elseif ($iteration <= 40000) {
                array_push($tempData8, $data);
            } elseif ($iteration <= 45000) {
                array_push($tempData9, $data);
            } elseif ($iteration > 45000) {
                array_push($tempData10, $data);
            }
            $iteration++;
        }
        Dataset::where('riwayat_id', $row->riwayat_id)->delete();

        Dataset::insert($tempData1);
        Dataset::insert($tempData2);
        Dataset::insert($tempData3);
        Dataset::insert($tempData4);
        Dataset::insert($tempData5);
        Dataset::insert($tempData6);
        Dataset::insert($tempData7);
        Dataset::insert($tempData8);
        Dataset::insert($tempData9);
        Dataset::insert($tempData10);

        return Dataset::where('riwayat_id', $riwayat->id)->get();
    }

    function conditionalPatternBase($dataSetPriority, $riwayat, $frequentItem)
    {
        $tempConditionalPatternBase1 = [];
        $tempConditionalPatternBase2 = [];
        $tempConditionalPatternBase3 = [];
        $tempConditionalPatternBase4 = [];
        $tempConditionalPatternBase5 = [];
        $tempConditionalPatternBase6 = [];
        $tempConditionalPatternBase7 = [];
        $tempConditionalPatternBase8 = [];
        $tempConditionalPatternBase9 = [];
        $tempConditionalPatternBase10 = [];
        foreach ($frequentItem->orderBy('id', 'DESC')->pluck('inisialisasi') as $row) {
            $iteration = 1;
            foreach ($dataSetPriority as $row2) {
                $namaBarang = explode(',', $row2->nama_barang);
                $tempFound = [];
                $found = array_search($row, $namaBarang); // menemukan index dari inisialisasi yang dicari
                if ($found) {
                    for ($i = 0; $i < $found; $i++) { // mengambil nama barang kebelakang yang memiliki inisialisasi yang dicari
                        array_push($tempFound, $namaBarang[$i]);
                    }
                    $data = [
                        'riwayat_id' => $riwayat->id,
                        'nama_barang' => $row,
                        'conditional_pattern_base' => implode(',', $tempFound)
                    ];
                    if ($iteration <= 5000) {
                        array_push($tempConditionalPatternBase1, $data);
                    } elseif ($iteration <= 10000) {
                        array_push($tempConditionalPatternBase2, $data);
                    } elseif ($iteration <= 15000) {
                        array_push($tempConditionalPatternBase3, $data);
                    } elseif ($iteration <= 20000) {
                        array_push($tempConditionalPatternBase4, $data);
                    } elseif ($iteration <= 25000) {
                        array_push($tempConditionalPatternBase5, $data);
                    } elseif ($iteration <= 30000) {
                        array_push($tempConditionalPatternBase6, $data);
                    } elseif ($iteration <= 35000) {
                        array_push($tempConditionalPatternBase7, $data);
                    } elseif ($iteration <= 40000) {
                        array_push($tempConditionalPatternBase8, $data);
                    } elseif ($iteration <= 45000) {
                        array_push($tempConditionalPatternBase9, $data);
                    } elseif ($iteration > 45000) {
                        array_push($tempConditionalPatternBase10, $data);
                    }
                }
                $iteration++;
            }
        }
        ConditionalPatternBase::insert($tempConditionalPatternBase1);
        ConditionalPatternBase::insert($tempConditionalPatternBase2);
        ConditionalPatternBase::insert($tempConditionalPatternBase3);
        ConditionalPatternBase::insert($tempConditionalPatternBase4);
        ConditionalPatternBase::insert($tempConditionalPatternBase5);
        ConditionalPatternBase::insert($tempConditionalPatternBase6);
        ConditionalPatternBase::insert($tempConditionalPatternBase7);
        ConditionalPatternBase::insert($tempConditionalPatternBase8);
        ConditionalPatternBase::insert($tempConditionalPatternBase9);
        ConditionalPatternBase::insert($tempConditionalPatternBase10);

        $conditionalPatternBase = ConditionalPatternBase::where('riwayat_id', $riwayat->id);

        return $conditionalPatternBase;
    }


    function frequentItemset($conditionalPatternBase, $riwayat, $countDataSet)
    {
        $item = $conditionalPatternBase->groupBy('nama_barang')->pluck('nama_barang');
        $tempData = [];
        foreach ($item as $row) {
            $temp2Itemset = [];
            $tempManyItemset = [];
            $cpb = ConditionalPatternBase::where('riwayat_id', $riwayat->id)->where('nama_barang', $row)->pluck('conditional_pattern_base');
            foreach ($cpb as $row2) {
                $tempCheck = [];
                $itemset = explode(',', $row2);
                array_push($temp2Itemset, $itemset);
                if (count($itemset) > 1) {
                    for ($i = 0; $i < count($itemset); $i++) {
                        for ($j = $i + 1; $j < count($itemset); $j++) {
                            array_push($tempManyItemset, $itemset[$i] . ',' . $itemset[$j]);
                            if (count($itemset) > 2) {
                                for ($k = $j + 1; $k < count($itemset); $k++) {
                                    array_push($tempManyItemset, $itemset[$i] . ',' . $itemset[$j] . ',' . $itemset[$k]);
                                }
                                if (count($itemset) > 3) {
                                    for ($l = $k + 1; $l < count($itemset); $l++) {
                                        array_push($tempManyItemset, $itemset[$i] . ',' . $itemset[$j] . ',' . $itemset[$k] . ',' . $itemset[$l]);
                                    }
                                    if (count($itemset) > 4) {
                                        for ($m = $l + 1; $m < count($itemset); $m++) {
                                            array_push($tempManyItemset, $itemset[$i] . ',' . $itemset[$j] . ',' . $itemset[$k] . ',' . $itemset[$l] . ',' . $itemset[$m]);
                                        }
                                        if (count($itemset) > 5) {
                                            for ($n = $m + 1; $n < count($itemset); $n++) {
                                                array_push($tempManyItemset, $itemset[$i] . ',' . $itemset[$j] . ',' . $itemset[$k] . ',' . $itemset[$l] . ',' . $itemset[$m] . ',' . $itemset[$n]);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $get2Itemset = $this->duaItemset($temp2Itemset);
            foreach ($get2Itemset as $key => $value) {
                $data = [
                    'riwayat_id' => $riwayat->id,
                    'itemset' => $key . ',' . $row,
                    'support_count' => $value,
                    'support' => $value / $countDataSet,
                ];
                if ($data['support_count'] >= $riwayat->minimum_support) {
                    array_push($tempData, $data);
                }
            }

            $getManyItemset = array_count_values($tempManyItemset);
            foreach ($getManyItemset as $key => $value) {
                $data = [
                    'riwayat_id' => $riwayat->id,
                    'itemset' => $key . ',' . $row,
                    'support_count' => $value,
                    'support' => $value / $countDataSet,
                ];
                if ($data['support_count'] >= $riwayat->minimum_support) {
                    array_push($tempData, $data);
                }
            }
        }

        FrequentItemset::insert($tempData);

        $frequentItemset = FrequentItemset::where('riwayat_id', $riwayat->id);
        return $frequentItemset;
    }

    function confidenceItemset($frequentItemset, $riwayat)
    {
        $tempConfidenceItemset = [];
        foreach ($frequentItemset->get() as $row) {
            $itemset = explode(',', $row->itemset);
            $getFrekuensiFirstItem = FrequentItem::where('riwayat_id', $riwayat->id)->where('inisialisasi', $itemset[0])->pluck('support_count')->first();

            $confidence = round(($row->support_count / $getFrekuensiFirstItem), 2);

            $data = [
                'riwayat_id' => $riwayat->id,
                'itemset' => $row->itemset,
                'support_count_A' => $getFrekuensiFirstItem,
                'support_count_itemset' => $row->support_count,
                'support' => $row->support,
                'confidence' => $confidence,
                'confidence_persen' => $confidence * 100,
            ];

            if ($data['confidence_persen'] >= $riwayat->minimum_confidence) {
                array_push($tempConfidenceItemset, $data);
            }
        }

        ConfidenceItemset::insert($tempConfidenceItemset);

        $confidenceItemset = ConfidenceItemset::where('riwayat_id', $riwayat->id);
        return $confidenceItemset;
    }

    function liftRatio($confidenceItemset, $riwayat)
    {
        $tempLiftRatio = [];
        foreach ($confidenceItemset->get() as $row) {
            $morethanone = [];
            $itemset = explode(',', $row->itemset);
            for ($i = 0; $i < count($itemset); $i++) {
                if ($i != 0) {
                    array_push($morethanone, $itemset[$i]);
                }
            }

            if (count($itemset) == 2) {
                $consequent = FrequentItem::where('riwayat_id', $riwayat->id)->where('inisialisasi', end($itemset))->pluck('support')->first();
            } else {
                $consequent = FrequentItemset::where('riwayat_id', $riwayat->id)->where('itemset', implode(',', $morethanone))->pluck('support')->first();
            }

            $liftRatio =  round(($row->confidence / $consequent), 2);
            $data = [
                'riwayat_id' => $riwayat->id,
                'support_B' => $consequent,
                'itemset' => $row->itemset,
                'support_count_itemset' => $row->support_count_itemset,
                'confidence' => $row->confidence,
                'confidence_persen' => $row->confidence_persen,
                'lift_ratio' => $liftRatio,
            ];
            array_push($tempLiftRatio, $data);
        }
        LiftRatio::insert($tempLiftRatio);
        $liftRatio = LiftRatio::where('riwayat_id', $riwayat->id);
        return $liftRatio;
    }

    function rule($liftRatio, $riwayat)
    {
        $tempHasilAkhir = [];
        foreach ($liftRatio->get() as $row) {
            $itemset = explode(',', $row->itemset);
            $countItemset = count($itemset);
            $tempItem1 = null;
            $tempItem2 = null;
            $tempItem3 = null;
            $tempItem4 = null;
            $tempItem5 = null;
            $tempItem6 = null;
            $tempItem7 = null;

            $if = null;
            $then = null;
            for ($i = 0; $i < $countItemset; $i++) {
                $item = FrequentItem::where('riwayat_id', $riwayat->id)->where('inisialisasi', $itemset[$i])->pluck('nama_barang')->first();
                if ($i == 0) {
                    $tempItem1 = $item;
                } else if ($i == 1) {
                    $tempItem2 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2;
                } else if ($i == 2) {
                    $tempItem3 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2 . ' dan ' . $tempItem3;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2 . ' dan ' . $tempItem3;
                } else if ($i == 3) {
                    $tempItem4 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2 . ', ' . $tempItem3 . ' dan ' . $tempItem4;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2 . ' dan ' . $tempItem3 . ' dan ' . $tempItem4;
                } else if ($i == 4) {
                    $tempItem5 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2 . ', ' . $tempItem3 . ', ' . $tempItem4 . ' dan ' . $tempItem5;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2 . ' dan ' . $tempItem3 . ' dan ' . $tempItem4 . ' dan ' . $tempItem5;
                } else if ($i == 5) {
                    $tempItem6 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2 . ', ' . $tempItem3 . ', ' . $tempItem4 . ', ' . $tempItem5 . ' dan ' . $tempItem6;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2 . ' dan ' . $tempItem3 . ' dan ' . $tempItem4 . ' dan ' . $tempItem5 . ' dan ' . $tempItem6;
                } else if ($i == 6) {
                    $tempItem7 = $item;
                    $if = $tempItem1;
                    $then = $tempItem2 . ', ' . $tempItem3 . ', ' . $tempItem4 . ', ' . $tempItem5 . ', ' . $tempItem6 . ' dan ' . $tempItem7;
                    // $rule = 'Jika membeli ' . $tempItem1 . ' maka akan membeli ' . $tempItem2 . ' dan ' . $tempItem3 . ' dan ' . $tempItem4 . ' dan ' . $tempItem5 . ' dan ' . $tempItem6 . ' dan ' . $tempItem7;
                }
            }

            $data = [
                'riwayat_id' => $riwayat->id,
                'if' => $if,
                'then' => $then,
                'support_count' => $row->support_count_itemset,
                'confidence_persen' => $row->confidence_persen,
                'lift_ratio' => $row->lift_ratio,
            ];
            array_push($tempHasilAkhir, $data);
        }
        Rule::insert($tempHasilAkhir);
        $rule = Rule::where('riwayat_id', $riwayat->id);
        return $rule;
    }

    function duaItemset($arr)
    {
        $arr2 = [];
        if (!is_array($arr['0'])) {
            $arr = array($arr);
        }
        foreach ($arr as $k => $v) {
            foreach ($v as $v2) {
                if (!isset($arr2[$v2])) {
                    $arr2[$v2] = 1;
                } else {
                    $arr2[$v2]++;
                }
            }
        }
        return $arr2;
    }

    public function dtHasil(Request $request)
    {
        if ($request->ajax()) {
            $riwayatTerakhir = Riwayat::orderBy('id', 'desc')->first();
            $data = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('rule', function ($row) {
                    $rule = 'Jika membeli ' . $row->if . ' maka akan membeli ' . $row->then;
                    return $rule;
                })
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AturanAsosiasi  $aturanAsosiasi
     * @return \Illuminate\Http\Response
     */
    public function show(AturanAsosiasi $aturanAsosiasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AturanAsosiasi  $aturanAsosiasi
     * @return \Illuminate\Http\Response
     */
    public function edit(AturanAsosiasi $aturanAsosiasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AturanAsosiasi  $aturanAsosiasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AturanAsosiasi $aturanAsosiasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AturanAsosiasi  $aturanAsosiasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(AturanAsosiasi $aturanAsosiasi)
    {
        //
    }
}
