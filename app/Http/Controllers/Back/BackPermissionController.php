<?php

namespace App\Http\Controllers\Back;

use App\Exceptions\ValidationException;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\SitePermission\BackPermissionRepository;
use Illuminate\Http\Request;

class BackPermissionController extends BackController
{
    private $sectionVars;
    /**
     * @var BackPermissionRepository
     */
    private $backPermissionRepository;


    public function __construct(BackPermissionRepository $backPermissionRepository)
    {
        parent::__construct();
        $this->sectionVars = array_add($this->sectionVars,'title','Permissions info');

        $this->vars = array_add(
            $this->vars,'section_title',
            view(config('settings.backEndTheme') . '.section-title.permissions.title')
                ->with($this->sectionVars)->render()
        );
        $this->backPermissionRepository = $backPermissionRepository;
    }

    public function index()
    {
        $this->vars = array_add($this->vars, 'content',
            view(config('settings.backEndTheme') . '.contents.permissions.index')
                ->with([
                    'roles' => Role::all(),
                    'permissions' => Permission::all(),
                    'messages' => $this->frontMessage->toArray()
                ])->render()
        );

        return $this->renderOutput();
    }

    public function update(Request $request)
    {
        try {
            $this->backPermissionRepository->validateUpdateData($request->except('_token'));
        } catch (ValidationException $exception) {
            $this->addErrorMessage(['errors' => json_decode($exception->getMessage(), true)]);
            return redirect()->back()->withInput();
        } catch (\Exception $exception) {
            $this->addErrorMessage(['errors' => $exception->getMessage()]);
            return redirect()->back()->withInput();
        }

        $this->changePermissions($request);
        $this->addFrontMessage(['message' => 'Permissions updated successfully']);
        return redirect()->back();
    }


    private function changePermissions ($request) {

        $data = $request->except('_token');
        $roles = Role::all();

        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            }
            else {
                $value->savePermissions([]);
            }
        }
        return true;
    }
}
