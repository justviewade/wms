<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_Layanan extends Model
{
    protected $table = 'tbl_jenis_layanan';
    protected $primaryKey = 'layanan_id';

    protected $guarded = [
        'layanan_id',
        'created_at',
        'updated_at'
    ];
}
