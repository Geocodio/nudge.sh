<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;

class UniquePhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $phoneNumber = preg_replace('~\D~', '', $value);
        return User::where('phone', $phoneNumber)->count() <= 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This phone number has already been registered.';
    }
}
