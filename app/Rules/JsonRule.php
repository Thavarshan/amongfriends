<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JsonRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ! is_null(json_decode($value, true));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The JSON data is invalid.';
    }
}
