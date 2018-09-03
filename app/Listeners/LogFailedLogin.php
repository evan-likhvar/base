<?php


namespace App\Listeners;

use App\Models\Auth\AuthFailedLogin;
use App\Models\Auth\AuthUserUnderAttack;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogFailedLogin
{

    public function handle(Login $event)
    {
        $ip = (Request::capture())->ip();

        $failed = AuthFailedLogin::where('ip', $ip)->first();

        $attacking = AuthUserUnderAttack::where('login', $event->credentials['email'])->first();

        if (!$attacking) {

            if (User::where('email', $event->credentials['email'])->first())
                AuthUserUnderAttack::create([
                    'login' => $event->credentials['email'],
                    'count_attempts' => 1
                ]);

        } else {
            $attacking->count_attempts += 1;
            $attacking->save();
        }

        if (!$failed) {
            AuthFailedLogin::create([
                'ip' => $ip,
                'date' => Carbon::now(),
                'count' => 1
            ]);
            return;
        }

        // check last activity by ip
        // if less than config setting increase count of attempt
        // else renew counting and activity date

        $lastActionDate = new Carbon($failed->date);

        if ($lastActionDate->diffInMinutes(Carbon::now()) < config('settings.loginControlTime')) {
            $failed->count += 1;
            $failed->save();
        } else {
            $failed->count = 1;
            $failed->date = Carbon::now();
            $failed->save();
        }

        // if count of attempt more than threshold to save IP into black list
        if ($failed->count > config('settings.maxLoginFailedByControlTime')) {
            DB::table('auth_ip_black_lists')
                ->insert([
                    'ip' => $ip,
                    'comment' => 'too many login attempts'
                ]);
        }
    }
}