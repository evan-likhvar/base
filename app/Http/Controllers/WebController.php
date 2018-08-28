<?php

namespace App\Http\Controllers;


use App\Repositories\Registry\SessionRegistry;
use App\Repositories\SiteMessageBag\SiteMessageBag;
use Illuminate\Support\Facades\Auth;

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
        $this->frontMessage = new SiteMessageBag();
        if (session('frontMessageBag')) {
            $this->frontMessage->merge(session('frontMessageBag'));
            session()->forget('frontMessageBag');
        }
    }

    protected function addFrontMessage(array $message)
    {
        $this->frontMessage->addArray('frontMessages', $message);
    }

    protected function addResultMessage(array $message)
    {
        $this->frontMessage->addArray('resultMessages', $message);
    }

    protected function addErrorMessage(array $message)
    {
        $this->frontMessage->addArray('errorMessages', $message);
    }
}