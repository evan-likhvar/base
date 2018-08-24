<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 22.08.18
 * Time: 14:27
 */

namespace App\Repositories\Auth;


use Illuminate\Support\Facades\Auth;

trait AuthRedirect
{
    protected function redirectTo(): string
    {
        if (Auth::check()) {
            if (Auth::user()->dashboard_enable == 1) {
                return '/dashboard';
            }
            return '/home';
        }
        return '/';
    }
}