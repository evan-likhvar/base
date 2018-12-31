<?php

namespace App\Http\Controllers\Back;


use App\Exceptions\ValidationException;
use App\Models\Language;
use App\Models\Role;
use App\Repositories\SiteUser\BackUserRepository;
use App\Repositories\SiteUser\BackUsers;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BackUserController extends BackController
{
    private $sectionVars;
    private $backUser;

    public function __construct(BackUserRepository $backUser)
    {
        parent::__construct();
        $this->backUser = $backUser;
    }

    public function index()
    {
        if (!empty($input = Request::capture()->all())) {
            try {
                $this->backUser->validateSort($input);
            } catch (\Exception $exception) {
                $this->addErrorMessage(['errors' => 'Sort parameters is not acceptable']);
                return redirect()->back()->withInput();
            }
        }

        $users = User::whereNested(function ($query) use ($input) {
            if (!empty($input['filter_name']))
                $query->where('name', 'like', $input['filter_name'] . '%');

            if (!empty($input['filter_email']))
                $query->where('email', 'like', $input['filter_email'] . '%');
        });

        if (!empty($input['sort'])) {
            $users->orderBy($input['sort'], $input['order']);
        } else {
            $users->orderBy('id', 'desc');
        }

        $users = $users->paginate(20);

        $this->vars = array_add(
            $this->vars, 'section_title', $this->getTitle('Roles info')
        );

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.users.index')
                ->with([
                    'users' => $users,
                    'messages' => $this->frontMessage->toArray(),
                ])->render()
        );

        return $this->renderOutput();
    }

    public function edit(int $userId)
    {
        $user = User::find($userId);
        $this->vars = array_add(
            $this->vars, 'section_title',
            $this->getTitle('User edit - <span style="color:#1e87f0"><b>' . $user->name . '</b></span>')
        );
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.users.edit')
                ->with([
                    'user' => $user,
                    'messages' => $this->frontMessage->toArray(),
                    'languages' => Language::all()->pluck('full_name', 'id')->toArray(),
                    'roles' => Role::all()->pluck('name', 'id')->toArray(),
                ])->render());
        return $this->renderOutput();

    }

    public function create()
    {
        $this->vars = array_add($this->vars, 'section_title', $this->getTitle('Define new site user'));
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.users.create')
                ->with([
                    'languages' => Language::all()->pluck('full_name', 'id')->toArray(),
                    'roles' => Role::all()->pluck('name', 'id')->toArray(),
                    'messages' => $this->frontMessage->toArray(),

                ])
                ->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        try {
            $data = $this->backUser->validateStoreData($request->all());
        } catch (ValidationException $e) {
            $this->addErrorMessage(['errors' => json_decode($e->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            $this->addErrorMessage(['errors' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        $user = User::create($data);
        $user->roles()->sync(array_keys($data['roles']));

        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> created successfully"]);

        return redirect()->route('backend.user.index');
    }

    public function update(Request $request, int $userId)
    {
        try {
            $user = $this->backUser->getUserById($userId);
            $data = $this->backUser->validateUpdateData($request->all());
        } catch (ModelNotFoundException $e) {
            $this->addErrorMessage(['errors' => "User not found"]);
            return redirect()->back()->withInput();
        } catch (ValidationException $e) {
            $this->addErrorMessage(['errors' => json_decode($e->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            $this->addErrorMessage(['errors' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        $user->update($data);
        $user->roles()->sync(array_keys($data['roles']));

        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {
        $this->sectionVars = array_add($this->sectionVars, 'title', $title);
        $this->sectionVars = array_add($this->sectionVars, 'users', new BackUsers());

        $this->vars = array_add(
            $this->vars, 'section_title',
            view(config('settings.backEndTheme') . '.section-title.users.title')
                ->with($this->sectionVars)->render()
        );
        return view(config('settings.backEndTheme') . '.section-title.users.title')
            ->with($this->sectionVars)->render();
    }
}
