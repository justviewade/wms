<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota_Tujuan extends Model
{
    protected $table = 'tbl_master_kota';
    protected $primaryKey = 'kota_id';

    protected $guarded = [
        'kota_id',
        'created_at',
        'updated_at'
    ];
}
