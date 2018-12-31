<?php

namespace App\Repositories\SitePermission;

use App\Exceptions\ValidationException;
use App\Rules\InPermissions;
use App\Rules\InRoles;
use App\User;
use Illuminate\Support\Facades\Validator;

class BackPermissionRepository
{

    public function validateUpdateData(array $data): bool
    {
        $validator = Validator::make([
            'roles'=>array_flip(array_keys($data)),
            'permissions'=>array_unique(array_flatten($data)),
        ],[
            'roles'=>['required','array', new InRoles()],
            'permissions'=>['required','array', new InPermissions()],
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return true;
    }

}
