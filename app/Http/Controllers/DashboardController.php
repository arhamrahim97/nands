<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
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
            'title' => 'Dashboard',

            'totalTransaksi' => DataTransaksi::groupBy('id_transaksi')->pluck('id_transaksi')->count(),
            'totalJenisBarang' => DataTransaksi::groupBy('nama_barang')->pluck('nama_barang')->count(),
            'jumlahJenisBarangTertinggi' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->first(),
            'jumlahJenisBarangTerendah' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->first(),

            'riwayatTerakhir' => $riwayatTerakhir,
            'if' => $ifJSON,
            'then' => $thenJSON,
            'support' => $supportJSON,
            'confidence' => $confidenceJSON,
            'liftRatio' => $liftRatioJSON,
        ];
        return view('dashboard', $data);
    }
}
