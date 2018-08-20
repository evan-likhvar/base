<?php

namespace App\Http\Controllers\Dev;


use App\Http\Controllers\WebController;

class DevController extends WebController
{

    public function setSessionVars(): void
    {
        $this->registry->set('v1',10);
        $this->registry->set('v2',10);
    }

    public function changeSessionVars(): void
    {
        $this->registry->set('v1',$this->registry->get('v1')+1);
        $this->registry->set('v2',$this->registry->get('v2')-1);
    }

    public function getSessionVars(string $key = null)
    {
        return $this->registry->get($key);
    }
}