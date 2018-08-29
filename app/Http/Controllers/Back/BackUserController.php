<?php

namespace App\Http\Controllers\Back;


use App\Repositories\SiteUser\BackUsers;
use App\User;
use Illuminate\Http\Request;

class BackUserController extends BackController
{
    private $sectionVars;

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $input = Request::capture()->all();

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
//todo Add user users into the user table content

        $this->vars = array_add(
            $this->vars,'section_title',$this->getTitle('Roles info')
        );

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.users.index')
                ->with('users', $users)->render()
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
                    'messages' => $this->frontMessage->toArray()
                ])->render());
        return $this->renderOutput();

    }
    public function create()
    {
        $this->vars = array_add($this->vars,'section_title', $this->getTitle('Define new site user'));
        $this->vars = array_add($this->vars, 'content', view(config('settings.backEndTheme') . '.contents.users.create')
            ->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> created successfully"]);
        return redirect()->route('backend.user.index');
    }

    public function update(Request $request, int $userId)
    {
        $user = User::find($userId);
        $user->update($request->all());
        $this->addFrontMessage(['message' => "User <b>$user->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {
        $this->sectionVars = array_add($this->sectionVars,'title','Users info');
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
