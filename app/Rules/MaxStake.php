<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxStake implements Rule
{
    const CODE = 3;
    const MAX = 10000;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value[$attribute] <= self::MAX;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            "code" => self::CODE,
            "message" => "Maximum stake amount is " . self::MAX
        ];
    }
}
