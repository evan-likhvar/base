<?php

namespace App\Http\Controllers\Back;


use App\Exceptions\ValidationException;
use App\Models\Role;
use App\Repositories\SiteRole\phpRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BackRoleController extends BackController
{
    private $sectionVars;

    private $roleRepository;

    public function __construct(phpRepository $roleRepository)
    {
        parent::__construct();

        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        if (!empty($input = Request::capture()->all())) {
            try {
                $this->roleRepository->validateSort($input);
            } catch (\Exception $exception) {
                $this->addErrorMessage(['errors' => 'Sort parameters is not acceptable']);
                return redirect()->back()->withInput();
            }
        }

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
                    'messages' => $this->frontMessage->toArray(),

                ])->render());
        return $this->renderOutput();

    }

    public function create()
    {
        $this->vars = array_add($this->vars, 'section_title', $this->getTitle('Define new site role'));
        $this->vars = array_add($this->vars, 'content', view(
            config('settings.backEndTheme') . '.contents.roles.create'
        )->with('messages', $this->frontMessage->toArray())->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        try {
            $this->roleRepository->validateStoreData($request->all());
        } catch (\Exception $exception) {
            $this->addErrorMessage(['errors' => json_decode($exception->getMessage(), true)]);
            return redirect()->back()->withInput();
        }

        $role = Role::create($request->all());
        $this->addFrontMessage(['message' => "Role <b>$role->name</b> created successfully"]);
        return redirect()->route('backend.role.index')->with('frontMessageBag', $this->frontMessage);
    }

    public function update(Request $request, int $roleId)
    {
        try {
            $role = $this->roleRepository->getRoleById($roleId);
            $data = $this->roleRepository->validateUpdateData($request->all());
        } catch (ModelNotFoundException $e) {
            $this->addErrorMessage(['errors' => "Role not found"]);
            return redirect()->back()->withInput();
        } catch (ValidationException $e) {
            $this->addErrorMessage(['errors' => json_decode($e->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            $this->addErrorMessage(['errors' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        $role->update($data);
        $this->addFrontMessage(['message' => "Role <b>$role->name</b> updated successfully"]);
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
