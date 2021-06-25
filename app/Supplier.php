<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'tbl_supplier';
    protected $primaryKey = 'supplier_id';

    protected $guarded = [
        'supplier_id',
        'created_at',
        'updated_at'
    ];
}
