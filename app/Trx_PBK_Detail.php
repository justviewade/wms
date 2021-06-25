<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBK_Detail extends Model
{
    protected $table = 'tbl_trx_pbk_detail';
    protected $primaryKey = 'trx_pbk_detail_id';

    protected $guarded = [
        'trx_pbk_detail_id',
        'created_at',
        'updated_at'
    ];
}
