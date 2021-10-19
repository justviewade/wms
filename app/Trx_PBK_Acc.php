<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBK_Acc extends Model
{
    protected $table = 'tbl_trx_pbk_acc';
    protected $primaryKey = 'trx_pbk_acc_id';

    protected $guarded = [
        'trx_pbk_acc_id',
        'created_at',
        'updated_at'
    ];
}
