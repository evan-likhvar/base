<?php


namespace App\Listeners;

use App\Models\LogUserLogin;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $lastLogin = LogUserLogin::where('user_id', $event->user->id)->orderBy('date', 'desc')->first();
        $event->user->last_login = ($lastLogin) ? $lastLogin->date : Carbon::now();
        try {
            $event->user->save();
            LogUserLogin::create([
                'user_id' => $event->user->id,
                'ip' => (Request::capture())->ip(),
                'date' => Carbon::now(),
            ]);
        } catch (\Exception $e) {
            //todo something with exception
        }
    }
}