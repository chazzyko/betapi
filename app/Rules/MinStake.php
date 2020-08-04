<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinStake implements Rule
{
    const MIN = 100;
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
     * @return array|string
     */
    public function message()
    {
        return ['code' => 2, 'message' => 'Minimum stake amount is ' . self::MIN];
    }
}
