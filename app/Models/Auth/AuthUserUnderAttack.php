<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class AuthUserUnderAttack extends Model
{
    protected $fillable = ['user_id','login','count_attempts'];
}
