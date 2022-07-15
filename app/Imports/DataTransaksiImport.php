<?php

namespace App\Imports;

use DateTime;
use App\Models\DataTransaksi;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DataTransaksiImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $jawaban_survey = DataTransaksi::where('kode_unik_survey', $row['kode_unik_survey'])
            //     ->where('soal_id', $row['soal_id'])
            //     ->where('kategori_soal_id', $row['kategori_soal_id'])
            //     ->first();
            // if ($jawaban_survey) {
            //     $jawaban_survey->delete();
            // }
            $date = DateTime::createFromFormat('m/d/Y', $row['tgljual']);
            $transform = $date->format('Y-m-d');
            DataTransaksi::create([
                'tanggal'  => $transform,
                'id_transaksi'  => $row['notrans'],
                'nama_barang'  => $row['nama'],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}
