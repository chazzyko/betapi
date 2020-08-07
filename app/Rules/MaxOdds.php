<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxOdds implements Rule
{
    const MAX = 10000;
    const CODE = 7;
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
        return (float)$value <= self::MAX;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message($parentArray = [])
    {
        $errors = [];

        if(isset($parentArray['id'])){
            $errors['id'] = $parentArray['id'];
        }

        $errors['errors'] = [
            'code' => self::CODE,
            'message' => 'Minimum odds are ' . self::MAX,
        ];


        return $errors;
    }
}
