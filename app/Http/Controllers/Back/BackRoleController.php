<?php

namespace App\Http\Controllers\Back;


use App\Models\Role;
use Illuminate\Http\Request;

class BackRoleController extends BackController
{
    private $sectionVars;

    public function __construct()
    {
        parent::__construct();
        $this->sectionVars = array_add($this->sectionVars,'title','Roles info');
        $this->sectionVars = array_add($this->sectionVars,'roles', Role::all());

        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.roles.title')
                ->with($this->sectionVars)->render()
        );
    }

    public function index()
    {
        $input = Request::capture()->all();

        $roles = Role::whereNested(function ($query) use ($input) {
            if (!empty($input['filter_name']))
                $query->where('name', 'like', $input['filter_name'] . '%');

            if (!empty($input['filter_email']))
                $query->where('email', 'like', $input['filter_email'] . '%');
        });

        if (!empty($input['sort'])) {
            $roles->orderBy($input['sort'], $input['order']);
        } else {
            $roles->orderBy('id', 'desc');
        }

        $roles = $roles->paginate(20);

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.roles.index')
                ->with('roles', $roles)->render()
        );

        return $this->renderOutput();
    }
}
