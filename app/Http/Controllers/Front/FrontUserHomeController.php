<?php

namespace App\Http\Controllers\Front;


use Illuminate\Support\Facades\Log;

class FrontUserHomeController extends FrontController
{

    public function index()
    {
        Log::info(__METHOD__);
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.frontEndTheme') . '.contents.front-user-dashboard'));
        return $this->renderOutput();
    }
}
