<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Front\FrontController;
use App\Repositories\Auth\AuthRedirect;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends FrontController
{
    use AuthRedirect;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
    }

    public function showResetForm(Request $request, $token = null)
    {
/*        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );*/

        $this->vars = array_add($this->vars, 'content',
            view(config('settings.themeRoot') . '.auth.passwords.reset')
                ->with([
                    'token' => $token,
                    'email' => $request->email
                    ])
                ->render());
        return $this->renderOutput();


    }
}
