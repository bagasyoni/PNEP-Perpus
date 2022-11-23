<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'peg';
    protected $fillable = ['kd_peg','na_peg','alamat','kontak','devisi','devisi','email','usrnm','tg_smp'];
}
