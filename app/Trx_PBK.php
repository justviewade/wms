<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBK extends Model
{
    protected $table = 'tbl_trx_pbk';
    protected $primaryKey = 'trx_pbk_id';

    protected $guarded = [
        'trx_pbk_id',
        'created_at',
        'updated_at'
    ];
}
