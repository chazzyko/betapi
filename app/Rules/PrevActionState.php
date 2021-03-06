<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PrevActionState implements Rule
{
    const CODE = 10;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return false;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Your previous action is not finished yet.',
        ];
    }
}
