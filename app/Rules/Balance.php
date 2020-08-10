<?php

namespace App\Rules;

use App\Player;
use Illuminate\Contracts\Validation\Rule;

class Balance implements Rule
{
    const CODE = 11;

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $player = Player::lockForUpdate()->where("player_id", $value[$attribute])->first();
        if (isset($value['stake_amount'])) {
            return ($player->balance > 0 && $player->balance >= abs((float)$value['stake_amount']));
        }

        return true;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Insufficient balance.'
        ];
    }
}
