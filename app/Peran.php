<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'tbl_peran';
    protected $primaryKey = 'peran_id';

    protected $guarded = [
        'peran_id',
        'created_at',
        'updated_at'
    ];
}
