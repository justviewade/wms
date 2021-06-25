<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tbl_tarif';
    protected $primaryKey = 'tarif_id';

    protected $guarded = [
        'tarif_id',
        'created_at',
        'updated_at'
    ];
}
