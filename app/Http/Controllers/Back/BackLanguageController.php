<?php

namespace App\Http\Controllers\Back;

use App\Models\Language;
use Illuminate\Http\Request;

class BackLanguageController extends BackController
{


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
            $this->vars,'section_title',$this->getTitle('Languages info')
        );
        $this->vars = array_add(
            $this->vars,
            'content',
            view(config('settings.backEndTheme') . '.contents.languages.index')
                ->with([
                    'languages'=> $languages,
                    'messages' => $this->frontMessage->toArray()
                    ])->render()
        );

        return $this->renderOutput();
    }

    public function edit(int $languageId)
    {
        $language = Language::find($languageId);
        $this->vars = array_add(
            $this->vars,'section_title',
            $this->getTitle('Language edit - <span style="color:#1e87f0"><b>'.$language->name.'</b></span>')
        );
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.languages.edit')
            ->with([
                'language' => $language,
                'messages' => $this->frontMessage->toArray()
            ])->render());
        return $this->renderOutput();

    }
    public function create()
    {
        $this->vars = array_add($this->vars,'section_title', $this->getTitle('Define new site language'));
        $this->vars = array_add($this->vars, 'content', view(config('settings.backEndTheme') . '.contents.languages.create')
            ->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        $language = Language::create($request->all());
        $this->addFrontMessage(['message' => "Language <b>$language->full_name</b> created successfully"]);
        return redirect()->route('backend.language.index')->with('frontMessageBag', $this->frontMessage);
    }

    public function update(Request $request, int $languageId)
    {
        $language = Language::find($languageId);
        $language->update($request->all());
        $this->addFrontMessage(['message' => "Language <b>$language->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {
        return view(config('settings.backEndTheme') . '.section-title.languages.title')
            ->with('title',$title)->render();
    }
}
