<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DuplicateSelections implements Rule
{
    const CODE = 8;

    /**
     * @param string $selections
     * @param mixed $val
     * @return bool
     */
    public function passes($selections, $val)
    {
        $count = 0;
        foreach ($selections as $selection) {
            if ($selection['id'] === $val) {
                $count += 1;
            }
        }

        return $count <= 1;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return [
            'code' => self::CODE,
            'message' => 'Duplicate selection found.',
        ];
    }
}
