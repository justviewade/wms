<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'tbl_pelanggan';
    protected $primaryKey = 'pelanggan_id';

    protected $guarded = [
        'customer_id',
        'created_at',
        'updated_at'
    ];
}
