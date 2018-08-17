<?php

namespace App\Http\Controllers;


use App\Repositories\Registry\SessionRegistry;

class WebController extends Controller
{
    protected $registry;

    public function __construct()
    {
        $this->registry = new SessionRegistry();
    }

}