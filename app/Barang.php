<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tbl_barang';
    protected $primaryKey = 'barang_id';

    protected $guarded = [
        'barang_id',
        'created_at',
        'updated_at'
    ];
}
