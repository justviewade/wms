<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'tbl_gudang';
    protected $primaryKey = 'gudang_id';

    protected $guarded = [
        'gudang_id',
        'created_at',
        'updated_at'
    ];
}
