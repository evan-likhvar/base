<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogUserLogin extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id','ip','date'];
}
