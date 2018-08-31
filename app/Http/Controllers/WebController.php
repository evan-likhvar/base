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
    protected $vars;
    protected $template;


    public function __construct()
    {
        $this->registry = new SessionRegistry();
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();
            $this->setupFrontMessageBag();
            return $next($request);
        });
    }
    public function renderOutput()
    {
        return view($this->template)->with($this->vars)->withMessages($this->frontMessage);
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
        $this->refreshSessionMessageBag();
    }

    protected function addResultMessage(array $message)
    {
        $this->frontMessage->addArray('resultMessages', $message);
        $this->refreshSessionMessageBag();
    }

    protected function addErrorMessage(array $message)
    {
        $this->frontMessage->addArray('errorMessages', $message);
        $this->refreshSessionMessageBag();
    }

    protected function renewSessionBag()
    {
        session()->forget('frontMessageBag');
        $this->setupFrontMessageBag();
    }
    private function refreshSessionMessageBag()
    {
        if (session('frontMessageBag'))
            session()->forget('frontMessageBag');
        session(['frontMessageBag'=>$this->frontMessage->toArray()]);
    }
}