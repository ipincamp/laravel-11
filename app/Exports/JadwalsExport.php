<?php

namespace App\Exports;

use App\Models\JadwalKuliah;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return JadwalKuliah::all();
    }
}
