<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\DataTransaksiImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DataTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'title' => 'Data Transaksi',
            'totalTransaksi' => DataTransaksi::groupBy('id_transaksi')->pluck('id_transaksi')->count(),
            'totalJenisBarang' => DataTransaksi::groupBy('nama_barang')->pluck('nama_barang')->count(),
            'jumlahJenisBarangTertinggi' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->first(),
            'jumlahJenisBarangTerendah' => DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'ASC')->first(),
        ];
        return view('data_transaksi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tabelDataTransaksi(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTransaksi::select('id_transaksi', DB::raw('GROUP_CONCAT(nama_barang) as nama_barang'), DB::raw("date_format(tanggal,'%d/%m/%Y') as tanggal"))->groupBy('id_transaksi')->groupBy('tanggal')->orderBy('tanggal', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function tabelDataBarang(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTransaksi::select('nama_barang', DB::raw('count(nama_barang) as jumlah'))->groupBy('nama_barang')->orderBy('jumlah', 'DESC')->orderBy('nama_barang', 'ASC')->get();
            // ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file_import' => 'required|mimes:csv,xls,xlsx',
            ],
            [
                'file_import.required' => 'File impor tidak boleh kosong',
                'file_import.mimes' => 'File impor harus berformat CSV, XLS, XLSX',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $is_truncate = $request->checkbox_import;
        if ($is_truncate) {
            DB::table('data_transaksi')->truncate();
        }
        Excel::import(new DataTransaksiImport, $request->file('file_import'));
        return 'berhasil';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataTransaksi  $dataTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(DataTransaksi $dataTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataTransaksi  $dataTransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(DataTransaksi $dataTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataTransaksi  $dataTransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTransaksi $dataTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataTransaksi  $dataTransaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTransaksi $dataTransaksi)
    {
        //
    }
}
