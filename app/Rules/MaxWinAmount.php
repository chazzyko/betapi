<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWinAmount implements Rule
{
    const MAXWIN = 20000;
    const CODE = 9;

    /**
     * @param string $attribute
     * @param mixed $input
     * @return bool
     */
    public function passes($attribute, $input)
    {
        $amount = 0;
        if (isset($input['stake_amount']) && isset($input['selections'])) {
            $amount = $input['stake_amount'];
            foreach ($input['selections'] as $selection) {
                if (isset($selection['odds'])) {
                    $amount *= $selection['odds'];
                }
            }
        }

        return $amount <= self::MAXWIN;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Max win amount is ' . self::MAXWIN,
        ];
    }
}
