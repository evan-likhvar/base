<?php

namespace App\Http\Controllers\Front;


class FrontUserHomeController extends FrontController
{

    public function index()
    {
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.frontEndTheme') . '.contents.front-user-dashboard'));
        return $this->renderOutput();
    }
}
