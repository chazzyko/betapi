<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DuplicateSelections implements Rule
{
    protected $id;
    const CODE = 8;
    protected $selections = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $selections)
    {
        $this->selections = $selections;
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
        $count = 0;
        $this->id = $value;
        foreach ($this->selections as $selection) {
            if(isset($selection['id']) && $selection['id'] === $value){
                $count += 1;
            }
        }

        return $count <= 1;
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function message()
    {
        return [
            'id' => $this->id,
            'errors' => [
                'code' => self::CODE,
                'message' => 'Duplicate selection found.',
            ]
        ];
    }
}
