<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\WebController;

class FrontController extends WebController
{

    public function __construct()
    {
        parent::__construct();
        $this->template = config('settings.frontEndTheme') . '.templates.main-template';
    }


    public function index()
    {
        $this->vars = array_add($this->vars, 'content', '');

        return $this->renderOutput();
    }
}