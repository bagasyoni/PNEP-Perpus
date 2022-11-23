<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devisi extends Model
{
    protected $table = 'devisi';
    protected $fillable = ['kd_dev','na_dev','flag','flag2','usrnm','tg_smp'];
}
