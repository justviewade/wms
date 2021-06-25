<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trx_PBM_Acc extends Model
{
    protected $table = 'tbl_trx_pbm_acc';
    protected $primaryKey = 'trx_pbm_acc_id';

    protected $guarded = [
        'trx_pbm_acc_id',
        'created_at',
        'updated_at'
    ];
}
