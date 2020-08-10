<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BetslipMismatch implements Rule
{
    const CODE = 1;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (isset($value[$attribute]));
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            "code" => self::CODE,
            "message" => "Betslip mismatch"
        ];
    }
}
