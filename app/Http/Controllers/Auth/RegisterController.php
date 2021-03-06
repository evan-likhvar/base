<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Auth\AuthRedirect;
use App\User;
use App\Http\Controllers\Front\FrontController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends FrontController
{
    use AuthRedirect;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
        $this->checkRequestCountPerHours();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $this->vars = array_add($this->vars, 'content', view(config('settings.themeRoot') . '.auth.register')->render());
        return $this->renderOutput();
    }

    private function checkRequestCountPerHours()
    {

        $ip = (Request::capture())->ip();
        $requestCount = DB::table('auth_register_user_requests')
            ->where('ip', $ip)->first();

        if (!$requestCount) {
            DB::table('auth_register_user_requests')
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

        if ($lastActionDate->diffInHours(Carbon::now()) < config('settings.registerUserControlTime')) {
            DB::table('auth_register_user_requests')
                ->where('id', $requestCount->id)
                ->update(['count' => $requestCount->count+1]);
        } else {
            DB::table('auth_register_user_requests')
                ->where('id', $requestCount->id)
                ->update(['count' => 1,'date'=>Carbon::now()]);
        }

        // if count of attempt more than threshold to save IP into black list
        if ($requestCount->count >= config('settings.maxRegisterUserByControlTime')) {
            DB::table('auth_ip_black_lists')
                ->insert([
                    'ip' => $ip,
                    'comment'=>'too many register user request'
                ]);
        }
    }
}
