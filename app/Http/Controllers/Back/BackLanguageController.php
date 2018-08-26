<?php

namespace App\Http\Controllers\Back;

use App\Models\Language;
use Illuminate\Http\Request;

class BackLanguageController extends BackController
{
    private $sectionVars;

    public function __construct()
    {
        parent::__construct();
        $this->sectionVars = array_add($this->sectionVars,'title','Language info');
        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.languages.title')
                ->with($this->sectionVars)->render()
        );
    }

    public function index()
    {
        $input = Request::capture()->all();

        $languages = Language::whereNested(function ($query) use ($input) {
            if (!empty($input['filter_name']))
                $query->where('name', 'like', $input['filter_name'] . '%');

            if (!empty($input['filter_email']))
                $query->where('email', 'like', $input['filter_email'] . '%');
        });

        if (!empty($input['sort'])) {
            $languages->orderBy($input['sort'], $input['order']);
        } else {
            $languages->orderBy('id', 'desc');
        }

        $languages = $languages->paginate(20);

        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.languages.index')
                ->with('languages', $languages)->render()
        );

        return $this->renderOutput();
    }
}
