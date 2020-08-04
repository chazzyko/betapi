<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinOdds implements Rule
{
    const MIN = 1;
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
        return $value >= self::MIN;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ['code' => 11, 'message' => 'Minimum odds are ' . self::MIN];
    }
}
