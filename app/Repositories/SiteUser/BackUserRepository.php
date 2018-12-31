<?php

namespace App\Repositories\SiteUser;

use App\Exceptions\ValidationException;
use App\Rules\InRoles;
use App\User;
use Illuminate\Support\Facades\Validator;

class BackUserRepository
{

    public function getUserById(int $userId) : User
    {
        return User::findorfail($userId);
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
            'language_id' =>'required|exists:languages,id',
            'active' => 'required|in:0,1',
            'dashboard_enable' => 'required|in:0,1',
            'roles'=>['required','array', new InRoles()],
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        if (isset($data['email']))
            unset($data['email']);

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
            'email' => 'required|string|email|max:255|unique:users',
            'language_id' =>'required|exists:languages,id',
            'active' => 'required|in:0,1',
            'dashboard_enable' => 'required|in:0,1',
            'password' => 'required|string|min:6|confirmed',
            'roles'=>['required','array', new InRoles()],
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
            'sort' => 'nullable|in:name,email,created_at,updated_at',
            'order'=> 'required_with:sort|in:asc,desc'
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return true;
    }
}
