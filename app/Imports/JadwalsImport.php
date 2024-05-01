<?php

namespace App\Imports;

use App\Models\JadwalKuliah;
use Maatwebsite\Excel\Concerns\ToModel;

class JadwalsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JadwalKuliah([
            'hari' => $row[0],
            'mata_kuliah' => $row[1],
            'waktu_mulai' => $row[2],
            'waktu_selesai' => $row[3],
            'ruang' => $row[4],
            'dosen' => $row[5],
            'jumlah_mahasiswa' => $row[6],
        ]);
    }
}
