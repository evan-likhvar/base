<?php

namespace App\Http\Controllers\Back;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class BackPermissionController extends BackController
{
    private $sectionVars;

    public function __construct()
    {
        parent::__construct();
        $this->sectionVars = array_add($this->sectionVars,'title','Permissions info');

        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.permissions.title')
                ->with($this->sectionVars)->render()
        );
    }

    public function index()
    {
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.permissions.index')
                ->with([
                    'roles' => Role::all(),
                    'permissions' => Permission::all(),
                    'messages' => $this->frontMessage->toArray()
                ])->render()
        );

        return $this->renderOutput();
    }

    public function update(Request $request)
    {
        $this->changePermissions($request);
        $this->addFrontMessage(['message' => 'Permissions updated successfully']);
        return redirect()->back();
    }


    private function changePermissions ($request) {

        $data = $request->except('_token');
        $roles = Role::all();

        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }
            else {
                $value->savePermissions([]);
            }
        }
        return true;
    }
}
