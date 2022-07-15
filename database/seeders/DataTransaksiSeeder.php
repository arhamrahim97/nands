<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'tanggal' => '2022-01-09',
                'id_transaksi' => 'T-001',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-09',
                'id_transaksi' => 'T-001',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-09',
                'id_transaksi' => 'T-001',
                'nama_barang' => 'KOPI BUBUK KAPAL API SPECIAL 30 GR'
            ],
            //
            [
                'tanggal' => '2022-01-09',
                'id_transaksi' => 'T-002',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-09',
                'id_transaksi' => 'T-002',
                'nama_barang' => 'PANTENE SHAMPO ANTI LEPEK 9 ML x 6 SACHET'
            ],
            //
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-003',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-003',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            //
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-004',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-004',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-004',
                'nama_barang' => 'PANTENE SHAMPO ANTI LEPEK 9 ML x 6 SACHET'
            ],
            //
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-005',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-10',
                'id_transaksi' => 'T-005',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            //
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-006',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-006',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            //
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-007',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-007',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            //
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-008',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-008',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-008',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            [
                'tanggal' => '2022-01-11',
                'id_transaksi' => 'T-008',
                'nama_barang' => 'KOPI BUBUK KAPAL API SPECIAL 30 GR'
            ],
            //
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-009',
                'nama_barang' => 'GULAKU MURNI 1 KG'
            ],
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-009',
                'nama_barang' => 'TEH SARI WANGI ISI 50'
            ],
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-009',
                'nama_barang' => 'SUSU BENDERA COKLAT 370 GR'
            ],
            //
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-010',
                'nama_barang' => 'TEPUNG TERIGU SEGITIGA BIRU 1 KG'
            ],
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-010',
                'nama_barang' => 'INDOMIE RASA AYAM BAWANG'
            ],
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-010',
                'nama_barang' => 'CLOSE UP TRIPLE FRESH 6 GR + 10 GR'
            ],
            [
                'tanggal' => '2022-01-12',
                'id_transaksi' => 'T-010',
                'nama_barang' => 'MY BABY MINYAK TELON PLUS 85 ML'
            ],
        ];
        DB::table('data_transaksi')->insert($data);
    }
}
