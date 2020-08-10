<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxOdds implements Rule
{
    const MAX = 10000;
    const CODE = 7;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (float)$value <= self::MAX;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Maximum odds are ' . self::MAX,
        ];
    }
}
