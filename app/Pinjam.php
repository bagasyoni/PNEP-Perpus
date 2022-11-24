<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'pinjam';
    protected $fillable = ['no_bukti','kd_member','na_member','tgl','id_buku','keterangan','status','usrnm'];
}
