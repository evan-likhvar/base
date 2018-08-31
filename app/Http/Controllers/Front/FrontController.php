<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;

class FrontController extends WebController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next)
        {
            $this->user = Auth::user();
            $this->vars = array_add($this->vars, 'navbar', view(config('settings.frontEndTheme') . '.navbars.main-navbar')->render());

            return $next($request);
        });
        $this->template = config('settings.frontEndTheme') . '.templates.main-template';
        $this->vars = array_add($this->vars, 'footer', view(config('settings.frontEndTheme') . '.footers.main-footer')->render());
    }


    public function index()
    {
        $this->vars = array_add($this->vars, 'content', view(config('settings.frontEndTheme') . '.contents.main-homepage')->render());
        return $this->renderOutput();
    }
}