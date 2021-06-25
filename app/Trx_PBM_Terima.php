<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBM_Terima extends Model
{
    protected $table = 'tbl_trx_pbm_terima';
    protected $primaryKey = 'trx_pbm_terima_id';

    protected $guarded = [
        'trx_pbm_terima_id',
        'created_at',
        'updated_at'
    ];
}
