<?php

namespace App\Http\Controllers\Back;


use App\Http\Controllers\WebController;
use App\User;

class BackApiController extends WebController
{

    public function toggleDashboardAccess(User $user)
    {
        if ($user && $user->dashboard_enable == 1)
            $user->dashboard_enable = 0;
        else
            $user->dashboard_enable = 1;

        $user->save();

        return response()->json([
            'result' => $user->dashboard_enable == 1 ? 'enabled' : 'disabled',
            'front_message' => $this->getHTMLAlertBox($user),
            'errors' => false
        ]);
    }

    private function getHTMLAlertBox(User $user)
    {
        return "<div id='front-message' uk-alert><a class='uk-alert-close' uk-close></a><p>User <b>$user->name</b> changed for dashboard access.</p></div>";
    }
}