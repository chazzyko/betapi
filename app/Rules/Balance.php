<?php

namespace App\Rules;

use App\Player;
use Illuminate\Contracts\Validation\Rule;

class Balance implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    const CODE = 11;

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
        $player =  Player::find($value);
        return $player->balance > 10000;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ['code' => self::CODE, 'message' =>'Insufficient funds.'];
    }
}
