<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinOdds implements Rule
{
    const MIN = 1;
    const CODE = 6;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (float)$value >= self::MIN;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Minimum odds are ' . self::MIN,
        ];
    }
}
