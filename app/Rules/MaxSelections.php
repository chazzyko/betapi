<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxSelections implements Rule
{
    const MAX = 20;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return count($value) <= self::MAX;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maximum number of selections ' . self::MAX;
    }
}
