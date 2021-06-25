<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBM_Detail extends Model
{
    protected $table = 'tbl_trx_pbm_detail';
    protected $primaryKey = 'trx_pbm_detail_id';

    protected $guarded = [
        'trx_pbm_detail',
        'created_at',
        'updated_at'
    ];
}
