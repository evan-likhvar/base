<?php

namespace App\Http\Controllers\Front;


class FrontUserHomeController extends FrontController
{

    public function index()
    {
        $this->vars = array_add($this->vars, 'content', view('home')->render());
        return $this->renderOutput();
    }
}