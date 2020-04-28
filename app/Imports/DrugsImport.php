<?php

namespace App\Imports;

use App\CentralDrug;
use Maatwebsite\Excel\Concerns\ToModel;

class DrugsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CentralDrug([
            "generic_name"=>$row[0],
            "trade_name"=>$row[1],
            "strength"=>$row[2],
            "dosage_form"=>$row[3],
            "tablet_type"=>$row[4],
            "num_tablet"=>$row[5],
            "price"=>$row[6],
            "quantity"=>1,
        ]);
    }
}
