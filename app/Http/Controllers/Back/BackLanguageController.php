<?php

namespace App\Http\Controllers\Back;

use App\Exceptions\ValidationException;
use App\Models\Language;
use App\Repositories\SiteLanguage\BackLanguageRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BackLanguageController extends BackController
{

    private $backLanguageRepository;

    public function __construct(BackLanguageRepository $backLanguageRepository)
    {
        parent::__construct();
        $this->backLanguageRepository = $backLanguageRepository;
    }

    public function index()
    {
        if (!empty($input = Request::capture()->all())) {
            try {
                $this->backLanguageRepository->validateSort($input);
            } catch (\Exception $exception) {
                $this->addErrorMessage(['errors' => 'Sort parameters is not acceptable']);
                return redirect()->back()->withInput();
            }
        }
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
        ->with('messages', $this->frontMessage->toArray())->render());
        return $this->renderOutput();
    }

    public function store(Request $request)
    {
        try {
            $data = $this->backLanguageRepository->validateStoreData($request->all());
        } catch (ValidationException $e) {
            $this->addErrorMessage(['errors' => json_decode($e->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            $this->addErrorMessage(['errors' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        $language = Language::create($data);
        $this->addFrontMessage(['message' => "Language <b>$language->full_name</b> created successfully"]);
        return redirect()->route('backend.language.index')->with('frontMessageBag', $this->frontMessage);
    }

    public function update(Request $request, int $languageId)
    {
        try {
            $language = $this->backLanguageRepository->getLanguageById($languageId);
            $data = $this->backLanguageRepository->validateUpdateData($request->all());
        } catch (ModelNotFoundException $e) {
            $this->addErrorMessage(['errors' => "Language not found"]);
            return redirect()->back()->withInput();
        } catch (ValidationException $e) {
            $this->addErrorMessage(['errors' => json_decode($e->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            $this->addErrorMessage(['errors' => $e->getMessage()]);
            return redirect()->back()->withInput();
        }

        $language->update($data);
        $this->addFrontMessage(['message' => "Language <b>$language->full_name</b> updated successfully"]);
        return redirect()->back();
    }

    private function getTitle(string $title)
    {
        return view(config('settings.backEndTheme') . '.section-title.languages.title')
            ->with('title',$title)->render();
    }
}
