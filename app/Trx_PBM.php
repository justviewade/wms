<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBM extends Model
{
    protected $table = 'tbl_trx_pbm';
    protected $primaryKey = 'trx_pbm_id';

    protected $guarded = [
        'trx_pbm_id',
        'created_at',
        'updated_at'
    ];
}
