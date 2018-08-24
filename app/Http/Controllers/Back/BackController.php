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

    public function renderOutput()
    {

        //dd($this->vars);

        return view($this->template)->with($this->vars);//->withMessages($this->frontMessage);
    }

    public function index()
    {
        /*  if (Gate::denies('viewAdminDashboard')) {
              abort(403);
          }*/

        //$this->authorize('viewAdminDashboard');



        $this->vars = array_add($this->vars, 'content', '');

        return $this->renderOutput();
    }
}