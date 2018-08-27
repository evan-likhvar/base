<?php

namespace App\Http\Controllers;


use App\Repositories\Registry\SessionRegistry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class WebController extends Controller
{
    protected $registry;
    protected $frontMessage;
    protected $user;

    public function __construct()
    {
        $this->registry = new SessionRegistry();
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();
            $this->setupFrontMessageBag();
            return $next($request);
        });
    }

    protected function setupFrontMessageBag()
    {
        $this->frontMessage = new MessageBag();
        if (session('frontMessageBag')) {
            $this->frontMessage->merge(session('frontMessageBag'));
            session()->forget('frontMessageBag');
        }
    }

    protected function addFrontMessage(string $message)
    {
        $this->frontMessage->add('frontMessages', $message);
    }
}