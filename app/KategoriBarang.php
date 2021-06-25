<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = 'tbl_kategori_barang';
    protected $primaryKey = 'kategori_id';

    protected $guarded = [
        'kategori_id',
        'created_at',
        'updated_at'
    ];
}
