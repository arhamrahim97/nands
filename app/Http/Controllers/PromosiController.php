<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Promosi;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePromosiRequest;
use App\Http\Requests\UpdatePromosiRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayatTerakhir = Riwayat::orderBy('id', 'DESC')->first();
        $rule = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->get();
        $if = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('if')->toArray();
        $then = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('then')->toArray();
        // $support = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('support_count')->toArray();
        $confidence = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('confidence_persen')->toArray();
        // $liftRatio = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('lift_ratio')->toArray();
        $barangTerlaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('nama_barang')->take(20)->toArray();
        $barangTerlarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('jumlah')->take(20)->toArray();
        $barangTerlarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->take(500)->get();

        $barangKurangLaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('nama_barang')->take(20)->toArray();
        $barangKurangLarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('jumlah')->take(20)->toArray();
        $barangKurangLarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->take(500)->get();


        # Start: Diagram
        $ifJSON = json_encode($if);
        $thenJSON = json_encode($then);
        // $supportJSON = json_encode($support);
        $confidenceJSON = json_encode($confidence);
        // $liftRatioJSON = json_encode($liftRatio);

        $barangTerlarisJSON = json_encode($barangTerlaris);
        $barangTerlarisCountJSON = json_encode($barangTerlarisCount);
        $barangKurangLarisJSON = json_encode($barangKurangLaris);
        $barangKurangLarisCountJSON = json_encode($barangKurangLarisCount);
        # End: Diagram

        $listDate = DataTransaksi::select(DB::raw("(DATE_FORMAT(tanggal, '%Y-%m')) as month_year"))
            ->groupBy('month_year')->orderBy('month_year', 'DESC')
            ->get();

        $data = [
            'title' => 'Promosi',
            'totalTransaksi' => DataTransaksi::groupBy('id_transaksi')->pluck('id_transaksi')->count(),
            'totalJenisBarang' => DataTransaksi::groupBy('nama_barang')->pluck('nama_barang')->count(),
            'jumlahJenisBarangTertinggi' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->first(),
            'jumlahJenisBarangTerendah' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->first(),

            'rule' => $rule,
            'riwayatTerakhir' => $riwayatTerakhir,
            'if' => $ifJSON,
            'then' => $thenJSON,
            // 'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            // 'liftRatio' => $liftRatioJSON,
            // 'barangKurangLaris' => $barangKurangLarisJSON,
            'riwayat' => Riwayat::latest()->get(),
            'barangTerlaris' => $barangTerlarisJSON,
            'barangTerlarisCount' => $barangTerlarisCountJSON,
            'barangTerlarisTable' => $barangTerlarisTable,
            'barangKurangLaris' => $barangKurangLarisJSON,
            'barangKurangLarisCount' => $barangKurangLarisCountJSON,
            'barangKurangLarisTable' => $barangKurangLarisTable,

            'listDate' => $listDate,
        ];
        return view('promosi', $data);
    }

    public function getRiwayatPromosi(Request $request, Riwayat $riwayat)
    {
        $riwayatTerakhir = Riwayat::where('id', $riwayat->id)->first();
        $rule = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->get();
        $if = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('if')->toArray();
        $then = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('then')->toArray();
        // $support = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('support_count')->toArray();
        $confidence = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('confidence_persen')->toArray();
        // $liftRatio = Rule::where('riwayat_id', $riwayatTerakhir->id ?? 0)->orderBy('confidence_persen', 'desc')->pluck('lift_ratio')->toArray();

        $ifJSON = json_encode($if);
        $thenJSON = json_encode($then);
        // $supportJSON = json_encode($support);
        $confidenceJSON = json_encode($confidence);
        // $liftRatioJSON = json_encode($liftRatio);

        $data = [
            'riwayatTerakhir' => $riwayatTerakhir,
            'rule' => $rule,
            'if' => $ifJSON,
            'then' => $thenJSON,
            // 'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            // 'liftRatio' => $liftRatioJSON,
        ];

        return view("partials.promosiItemset")->with($data)
            ->render();
    }

    public function getBarangLarisPromosi(Request $request)
    {
        $date = $request->date;

        if ($date != '') {
            $dateArr = explode('-', $date);
            $month = $dateArr[1];
            $year = $dateArr[0];
            $barangTerlaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('nama_barang')->take(20)->toArray();
            $barangTerlarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('jumlah')->take(20)->toArray();
            $barangTerlarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->take(500)->get();
        } else {
            $barangTerlaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('nama_barang')->take(20)->toArray();
            $barangTerlarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->pluck('jumlah')->take(20)->toArray();
            $barangTerlarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'DESC')->take(500)->get();
        }


        $barangTerlarisJSON = json_encode($barangTerlaris);
        $barangTerlarisCountJSON = json_encode($barangTerlarisCount);

        $data = [
            'barangTerlaris' => $barangTerlarisJSON,
            'barangTerlarisCount' => $barangTerlarisCountJSON,
            'barangTerlarisTable' => $barangTerlarisTable,
        ];
        return view("partials.promosiItemDesc")->with($data)
            ->render();
    }

    public function getBarangKurangLarisPromosi(Request $request)
    {
        $date = $request->date;
        // return $date;
        if ($date != '') {
            $dateArr = explode('-', $date);
            $month = $dateArr[1];
            $year = $dateArr[0];
            $barangKurangLaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('nama_barang')->take(20)->toArray();
            $barangKurangLarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('jumlah')->take(20)->toArray();
            $barangKurangLarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->take(500)->get();
        } else {
            $barangKurangLaris = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('nama_barang')->take(20)->toArray();
            $barangKurangLarisCount = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->pluck('jumlah')->take(20)->toArray();
            $barangKurangLarisTable = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->orderBy('nama_barang', 'ASC')->take(500)->get();
        }


        $barangKurangLarisJSON = json_encode($barangKurangLaris);
        $barangKurangLarisCountJSON = json_encode($barangKurangLarisCount);

        $data = [
            'barangKurangLaris' => $barangKurangLarisJSON,
            'barangKurangLarisCount' => $barangKurangLarisCountJSON,
            'barangKurangLarisTable' => $barangKurangLarisTable,
        ];
        return view("partials.promosiItemAsc")->with($data)
            ->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromosiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromosiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function show(Promosi $promosi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function edit(Promosi $promosi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromosiRequest  $request
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromosiRequest $request, Promosi $promosi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promosi  $promosi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promosi $promosi)
    {
        //
    }
}
