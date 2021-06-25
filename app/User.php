<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';

    protected $guarded = [
        'user_id',
        'created_at',
        'updated_at'
    ];
}
