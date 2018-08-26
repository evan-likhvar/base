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
        $this->sectionVars = array_add($this->sectionVars,'title','Users info');
        $this->sectionVars = array_add($this->sectionVars,'users',new BackUsers());

        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.users.title')
                ->with($this->sectionVars)->render()
        );
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
//todo Add user roles into the user table content
        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.users.index')
                ->with('users', $users)->render()
        );

        return $this->renderOutput();
    }
}
