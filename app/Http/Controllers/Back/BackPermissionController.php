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
                    'permissions' => Permission::all()
                ])->render()
        );

        return $this->renderOutput();
    }
}
