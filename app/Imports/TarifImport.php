<?php

namespace App\Imports;

use App\Tarif;
use Maatwebsite\Excel\Concerns\ToModel;

class TarifImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tarif([
            'kota_tujuan' => $row[1], 
            'tarif_normal' => $row[2], 
            'lead_time_normal' => $row[3], 
            'tarif_urgent' => $row[4], 
            'lead_time_urgent' => $row[5], 
            'tarif_ons' => $row[6], 
            ]);
        }
}
