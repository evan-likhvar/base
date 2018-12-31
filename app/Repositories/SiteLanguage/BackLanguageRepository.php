<?php

namespace App\Repositories\SiteLanguage;

use App\Exceptions\ValidationException;
use App\Models\Language;
use Illuminate\Support\Facades\Validator;

class BackLanguageRepository
{

    public function getLanguageById(int $id) : Language
    {
        return Language::findorfail($id);
    }

    /**
     * @param array $data
     * @return array
     * @throws ValidationException
     */
    public function validateUpdateData(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|size:2',
            'full_name' => 'required|string|max:30',
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
            'name' => 'required|string|size:2',
            'full_name' => 'required|string|max:30',
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
            'sort' => 'nullable|in:name,full_name,created_at,updated_at',
            'order'=> 'required_with:sort|in:asc,desc'
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->getMessageBag()->toArray()));
        }

        return true;
    }
}
