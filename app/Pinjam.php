<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $table = 'keluar';
    protected $fillable = ['no_bukti','na_peg','devisi','tgl','ket','buku_id'];
}
