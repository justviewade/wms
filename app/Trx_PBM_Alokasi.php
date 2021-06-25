<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBM_Alokasi extends Model
{
    protected $table = 'tbl_trx_pbm_alokasi';
    protected $primaryKey = 'trx_pbm_alokasi_id';

    protected $guarded = [
        'trx_pbm_alokasi_id',
        'created_at',
        'updated_at'
    ];
}
