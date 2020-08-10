<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxSelections implements Rule
{
    const MAX = 20;
    const CODE = 5;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return count($value) <= self::MAX;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Maximum number of selections: ' . self::MAX
        ];
    }
}
