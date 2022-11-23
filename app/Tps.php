<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $table    =   'tps';
    protected $fillable =  [
        'user_id',
        'name', 
        'address'
    ];
}
