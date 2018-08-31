<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\WebController;

class FrontController extends WebController
{

    public function __construct()
    {
        parent::__construct();
        $this->template = config('settings.frontEndTheme') . '.templates.main-template';
        $this->vars = array_add($this->vars, 'navbar', view(config('settings.frontEndTheme') . '.navbars.main-navbar')->render());
        $this->vars = array_add($this->vars, 'footer', view(config('settings.frontEndTheme') . '.footers.main-footer')->render());
    }


    public function index()
    {
        $this->vars = array_add($this->vars, 'content', view(config('settings.frontEndTheme') . '.contents.main-homepage')->render());
        return $this->renderOutput();
    }
}