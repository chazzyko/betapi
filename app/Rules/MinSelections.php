<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinSelections implements Rule
{
    const MIN = 1;
    const CODE = 4;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return count($value) >= self::MIN;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Minimum number of selections ' . self::MIN
        ];
    }
}
