<?php

namespace App\Imports;

use App\Regsk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RegskImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Regsk::create([
                'nama_sk'=>$row[0],
                'no_sk'=>$row[1],
                'tgl_sk'=>$row[2],
                'bidang_sk'=>$row[3]
            ]);
        }
    }
}
