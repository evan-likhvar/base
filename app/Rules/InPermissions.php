<?php

namespace App\Rules;

use App\Models\Permission;
use Illuminate\Contracts\Validation\Rule;

class InPermissions implements Rule
{
    public function passes($attribute, $value)
    {
        return count($value) === count(array_intersect(Permission::all()->pluck('id')->toArray(),$value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Permissions array is invalid';
    }
}
