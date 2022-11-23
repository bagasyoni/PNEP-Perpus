<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjamd extends Model
{
    protected $table = 'keluard';
    protected $fillable = ['no_bukti','kd_buku','na_buku','genre','ket'];
}
