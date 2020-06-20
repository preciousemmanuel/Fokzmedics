<?php

namespace App\Imports;

use App\Centraltest;
use Maatwebsite\Excel\Concerns\ToModel;

class TestsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Centraltest([
            "name"=>$row[0],
            "price"=>$row[1]
        ]);
    }
}
