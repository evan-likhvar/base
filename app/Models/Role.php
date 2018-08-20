<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'active',
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    public function permissions() {
        return $this->belongsToMany('App\Models\Permission');
    }

}
