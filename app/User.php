<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','language_id','dashboard_enable','active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }

    public function userLanguageName()
    {
        return $this->language ? $this->language->name : config('settings.defaultCountryLanguage');
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    //  'string'  array('View_Admin','ADD_ARTICLES')
    //
    public function canDo($permission, $require = FALSE) {

        if(is_array($permission)) {
            foreach($permission as $permName) {

                $permName = $this->canDo($permName);
                if($permName && !$require) {
                    return TRUE;
                }
                else if(!$permName  && $require) {
                    return FALSE;
                }
            }

            return  $require;
        }
        else {
            foreach($this->roles as $role) {
                foreach($role->permissions as $perm) {
                    if(str_is($permission,$perm->name)) {
                        return TRUE;
                    }
                }
            }
        }

        return false;

    }

    // string  ['role1', 'role2']
    public function hasRole($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$require) {
                    return true;
                } elseif (!$hasRole && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }
}
