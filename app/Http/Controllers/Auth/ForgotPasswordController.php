<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Front\FrontController;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends FrontController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
        $this->checkRequestCountPerMinute();
    }

    public function showLinkRequestForm()
    {
        $this->vars = array_add($this->vars, 'content', view(config('settings.themeRoot') . '.auth.passwords.email')->render());
        return $this->renderOutput();
    }

    private function checkRequestCountPerMinute()
    {

        $ip = (Request::capture())->ip();
        $requestCount = DB::table('auth_reset_login_requests')
            ->where('ip', $ip)->first();

        if (!$requestCount) {
            DB::table('auth_reset_login_requests')
                ->insert([
                    'ip'=>$ip,
                    'date' => Carbon::now(),
                    'count' => 1
                ]);
            return;
        }

        // check last activity by ip
        // if less than config setting increase count of attempt
        // else renew counting and activity date

        $lastActionDate = new Carbon($requestCount->date);

        if ($lastActionDate->diffInSeconds(Carbon::now()) < config('settings.resetControlTime')) {
            DB::table('auth_reset_login_requests')
                ->where('id', $requestCount->id)
                ->update(['count' => $requestCount->count+1]);
        } else {
            DB::table('auth_reset_login_request')
                ->where('id', $requestCount->id)
                ->update(['count' => 1,'date'=>Carbon::now()]);
        }

        // if count of attempt more than threshold to save IP into black list
        if ($requestCount->count >= config('settings.maxResetByControlTime')) {
            DB::table('auth_ip_black_lists')
                ->insert([
                    'ip' => $ip,
                    'comment'=>'too many password reset request'
                ]);
        }
    }

}
