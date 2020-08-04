<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxOdds implements Rule
{
    const MAX = 10000;
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
        return $value <= self::MAX;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ['code' => 12, 'message' => 'Maximum odds are ' . self::MAX];
    }
}
