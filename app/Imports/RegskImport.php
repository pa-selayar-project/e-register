<?php

namespace App\Imports;

use App\Regsk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RegskImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach($collection as $row) {   
            Regsk::create([
                'nama_sk'=>$row[4],
                'desc_sk'=>$row[4],
                'no_sk'=>$row[0].$row[1].$row[2],
                'tgl_sk'=>$row[3],
                'bidang_sk'=>$row[5],
                'ttd_sk'=>$row[6],
                'obyek'=>'',
                'tahun'=>date('Y')
            ]);
        }
    }
}
