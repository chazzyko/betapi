<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWinAmount implements Rule
{
    const MAXWIN = 20000;
    const CODE = 9;

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
     * @param string $attribute
     * @param $input
     * @return bool
     */
    public function passes($attribute, $input)
    {
        $amount = 0;
        if(isset($input['stake_amount']) && isset($input['selections'])){
            $amount = $input['stake_amount'];
            foreach ($input['selections'] as $selection) {
                if(isset($selection['odds'])){
                    $amount *= $selection['odds'];
                }
            }
        }

        return $amount <= self::MAXWIN;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Max win amount is ' . self::MAXWIN,
        ];
    }
}
