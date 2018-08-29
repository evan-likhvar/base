<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\WebController;

class BackController extends WebController
{
    protected $vars;
    protected $template;

    public function __construct()
    {
        parent::__construct();
        $this->template = config('settings.backEndTheme') . '.templates.main-template';
    }



    public function index()
    {
        $this->vars = array_add($this->vars, 'content', '');

        return $this->renderOutput();
    }
}