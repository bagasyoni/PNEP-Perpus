<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $table = 'kembali';
    protected $fillable = ['no_bukti','kd_member','na_member','tgl','id_buku','keterangan','status','usrnm'];
}
