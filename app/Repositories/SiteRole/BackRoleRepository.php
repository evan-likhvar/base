<?php

namespace App\Repositories\SiteRole;

use App\Exceptions\ValidationException;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class BackRoleRepository
{

    public function getRoleById(int $userId) : Role
    {
        return Role::findorfail($userId);
    }

    /**
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function validateUpdateData(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'active' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function validateStoreData(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return $data;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validateSort(array $data): bool
    {
        $validator = Validator::make($data,[
            'sort' => 'nullable|in:name,created_at,updated_at',
            'order'=> 'required_with:sort|in:asc,desc'
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return true;
    }
}
