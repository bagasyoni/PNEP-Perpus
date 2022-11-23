<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $fillable = ['kd_member', 'na_member', 'alamat', 'kontak'];
}
