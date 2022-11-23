<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $table        =   'voting';
    protected $fillable     =   [
        'tps_id',
        'jumlah',
        'file',
        'status'
    ];
}
