<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinStake implements Rule
{
    const MIN = 0.3;
    const CODE = 2;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value[$attribute] >= self::MIN;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            "code" => self::CODE,
            'message' => "Minimum stake amount is " . self::MIN
        ];
    }
}
