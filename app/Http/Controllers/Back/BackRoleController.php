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
            $this->vars, 'section_title', $this->getTitle('Roles info')
        );

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.roles.index')
                ->with([
                    'roles' => $roles,
                    'messages' => $this->frontMessage->toArray()
                ])->render());

        return $this->renderOutput();
    }

    public function edit(int $roleId)
    {
        $role = Role::find($roleId);
        $this->vars = array_add(
            $this->vars, 'section_title',
            $this->getTitle('Role edit - <span style="color:#1e87f0"><b>' . $role->name . '</b></span>')
        );
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.roles.edit')
                ->with([
                    'role' => $role,
                    'messages' => $this->frontMessage->toArray()
                ])->render());
        return $this->renderOutput();

    }

    public function create()
    {
        $this->vars = array_add($this->vars, 'section_title', $this->getTitle('Define new site role'));
        $this->vars = array_add($this->vars, 'content', view(config('settings.backEndTheme') . '.contents.roles.create')
            ->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $this->addFrontMessage(['message' => "Role <b>$role->full_name</b> created successfully"]);
        return redirect()->route('backend.role.index')->with('frontMessageBag', $this->frontMessage);
    }

    public function update(Request $request, int $roleId)
    {
        $role = Role::find($roleId);
        $role->update($request->all());
        $this->addFrontMessage(['message' => "Role <b>$role->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {

        $this->sectionVars = array_add($this->sectionVars, 'title', $title);
        $this->sectionVars = array_add($this->sectionVars, 'roles', Role::all());

        $this->vars = array_add(
            $this->vars, 'section_title',
            view(config('settings.backEndTheme') . '.section-title.roles.title')
                ->with($this->sectionVars)->render()
        );
        return view(config('settings.backEndTheme') . '.section-title.roles.title')
            ->with($this->sectionVars)->render();
    }
}
