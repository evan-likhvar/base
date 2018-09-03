<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Front\FrontController;
use App\Repositories\Auth\AuthRedirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends FrontController
{
    use AuthRedirect;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }

    public function showLoginForm()
    {
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.themeRoot') . '.auth.login')->render());
        return $this->renderOutput();
    }
}
