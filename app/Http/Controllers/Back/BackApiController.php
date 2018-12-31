<?php

namespace App\Http\Controllers\Back;


use App\Http\Controllers\WebController;
use App\Models\Language;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class BackApiController extends WebController
{

    public function toggleDashboardAccessProperty(Request $request)
    {
        $this->validate($request, ['userId' => 'required|numeric']);

        if (!$user=User::find($request->input('userId')))
            $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('User not found')]);
        else {
            $user->dashboard_enable = $user->dashboard_enable == 1 ? 0 : 1;
            try {
                $user->save();
            } catch (\Exception $e) {
                $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Store user error:  '.$e->getMessage())]);
            }
            $this->addFrontMessage(['message' => $this->getHTMLAlertBox($user)]);
            $this->addResultMessage(['result'=>$user->dashboard_enable == 1 ? 'enabled' : 'disabled']);
        }
        return response()->json($this->frontMessage->getMessages());
    }

    public function toggleUserActiveProperty(Request $request)
    {
        $this->validate($request, ['userId' => 'required|numeric']);

        if (!$user=User::find($request->input('userId')))
            $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('User not found')]);
        else {
            $user->active = $user->active == 1 ? 0 : 1;
            try {
                $user->save();
            } catch (\Exception $e) {
                $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Store user error:  '.$e->getMessage())]);
            }
            $this->addFrontMessage(['message' => $this->getHTMLAlertBox($user)]);
            $this->addResultMessage(['result'=>$user->active == 1 ? 'yes' : 'no']);
        }
        return response()->json($this->frontMessage->getMessages());
    }

    public function toggleRoleActiveProperty(Request $request)
    {
        $this->validate($request, ['roleId' => 'required|numeric']);

        if (!$role=Role::find($request->input('roleId')))
            $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Role not found')]);
        else {
            $role->active = $role->active == 1 ? 0 : 1;
            try {
                $role->save();
            } catch (\Exception $e) {
                $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Store role error:  '.$e->getMessage())]);
            }
            $this->addFrontMessage(['message' => $this->getHTMLRoleAlertBox($role)]);
            $this->addResultMessage(['result'=>$role->active == 1 ? 'yes' : 'no']);
        }
        return response()->json($this->frontMessage->getMessages());
    }

    public function toggleLanguageActiveProperty(Request $request)
    {
        $this->validate($request, ['languageId' => 'required|numeric']);

        if (!$language=Language::find($request->input('languageId')))
            $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Language not found')]);
        else {
            $language->active = $language->active == 1 ? 0 : 1;
            try {
                $language->save();
            } catch (\Exception $e) {
                $this->addErrorMessage(['errors' => $this->getHTMLAlertErrorBox('Store language error:  '.$e->getMessage())]);
            }
            $this->addFrontMessage(['message' => $this->getHTMLLanguageAlertBox($language)]);
            $this->addResultMessage(['result'=>$language->active == 1 ? 'yes' : 'no']);
        }

        return response()->json($this->frontMessage->getMessages());
    }

    public function clearMessageBag()
    {
        $this->renewSessionBag();
        return response()->json(['result'=>true]);
    }

    private function getHTMLAlertBox(User $user)
    {
        return "<div id='front-message' class='uk-alert-primary uk-padding-small uk-margin-small' uk-alert>
<a class='uk-alert-close' uk-close></a><p>User <b>$user->name</b> changed.</p></div>";
    }

    private function getHTMLRoleAlertBox(Role $role)
    {
        return "<div id='front-message' class='uk-alert-primary uk-padding-small uk-margin-small' uk-alert>
<a class='uk-alert-close' uk-close></a><p>Role <b>$role->name</b> changed.</p></div>";
    }

    private function getHTMLLanguageAlertBox(Language $language)
    {
        return "<div id='front-message' class='uk-alert-primary uk-padding-small uk-margin-small' uk-alert>
<a class='uk-alert-close' uk-close></a><p>Language <b>$language->name</b> changed.</p></div>";
    }

    private function getHTMLAlertErrorBox($message = 'Unknown error')
    {
        return "<div id='front-message' class=\"uk-alert-danger uk-padding-small uk-margin-small\" uk-alert>
<a class='uk-alert-close' uk-close></a><p> <b>$message</b> </p></div>";
    }
}
