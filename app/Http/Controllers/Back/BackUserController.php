<?php

namespace App\Http\Controllers\Back;


use App\Models\Language;
use App\Models\Role;
use App\Repositories\SiteUser\BackUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BackUserController extends BackController
{
    private $sectionVars;


    public function index()
    {
        $input = Request::capture()->all();

        if (!empty($input)) {
            $validator = Validator::make($input,[
                'sort' => 'nullable|in:nayme,email,created_at,updated_at',
                'order'=> 'required_with:sort|in:asc,desc'
            ]);
        }

        if (isset($validator) && $validator->fails()) {

            $this->renewSessionBag();

            $tm1 = $validator->errors()->all();
            $tm2 = $validator->errors()->messages();
            $tm3 = $validator->getMessageBag()->toArray();
            $tm4 = $validator->getMessageBag()->keys();

            $this->addErrorMessage(['errors' => 'fghrghrg']);


        } else {
            $this->renewSessionBag();

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
            $this->vars,'section_title',$this->getTitle('Roles info')
        );

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.users.index')
                ->with([
                    'users'=> $users,
                    'messages' => $this->frontMessage->toArray(),
                ])->render()
        );

        return $this->renderOutput();
    }

    public function edit(int $userId)
    {
        $user = User::find($userId);
        $this->vars = array_add(
            $this->vars,'section_title',
            $this->getTitle('User edit - <span style="color:#1e87f0"><b>'.$user->name.'</b></span>')
        );
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.users.edit')
                ->with([
                    'user' => $user,
                    'messages' => $this->frontMessage->toArray(),
                    'languages'=> Language::all()->pluck('full_name','id')->toArray(),
                    'roles' => Role::all()->pluck('name','id')->toArray(),
                ])->render());
        return $this->renderOutput();

    }
    public function create()
    {
        $this->vars = array_add($this->vars,'section_title', $this->getTitle('Define new site user'));
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.users.create')
                ->with([
                    'languages'=> Language::all()->pluck('full_name','id')->toArray(),
                    'roles' => Role::all()->pluck('name','id')->toArray(),
                    'messages' => $this->frontMessage->toArray(),

                ])
                ->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'language_id' =>'required|exists:languages,id',
            'active' => 'required|in:0,1',
            'dashboard_enable' => 'required|in:0,1',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            $this->addErrorMessage(['errors' => $validator->getMessageBag()->toArray()]);
            return redirect()->back()->withInput();
        }


        $user = User::create($request->all());
        $user->roles()->sync(array_keys($request['roles']));

        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> created successfully"]);

        return redirect()->route('backend.user.index');
    }

    public function update(Request $request, int $userId)
    {
        $user = User::find($userId);
        $user->update($request->all());
        $user->roles()->sync(array_keys($request['roles']));

        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {
        $this->sectionVars = array_add($this->sectionVars,'title',$title);
        $this->sectionVars = array_add($this->sectionVars,'users',new BackUsers());

        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.users.title')
                ->with($this->sectionVars)->render()
        );
        return view(config('settings.backEndTheme') . '.section-title.users.title')
            ->with($this->sectionVars)->render();
    }
}
