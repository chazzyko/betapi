<?php

namespace App\Validator;

class Validator
{
    protected $errors = [];

    public function global(array $input = [], array $rules = [])
    {
        if ($input && $rules) {
            foreach ($rules as $key => $rule) {
                if (isset($rule)) {
                    foreach ($rule as $validationRule) {
                        if (!$validationRule->passes($key, $input)) {
                            $this->errors["errors"][] = $validationRule->message();
                            break;
                        }
                    }
                }
            }
        }

        return $this->errors;
    }

    public function checkSelection(array $input, array $rules)
    {
        if (isset($input['selections']) && $rules) {
            foreach ($input['selections'] as $key => $selection) {
                $currentErrors = [];
                foreach ($selection as $key => $value) {
                    if (isset($rules[$key])) {
                        foreach ($rules[$key] as $validationRule) {
                            if (!$validationRule->passes($input['selections'], $value)) {
                                if (!isset($currentErrors['id'])) {
                                    $currentErrors['id'] = $selection['id'];
                                }
                                $currentErrors['erorrs'][] = $validationRule->message();
                            }
                        }
                    }
                }
                if ($currentErrors) {
                    $this->errors['selections'][] = $currentErrors;
                }
            }
        }

        return $this->errors;
    }

    public function checkWin(array $input, $validationRule)
    {
        if (!$validationRule->passes($key = "", $input)) {
            return $this->errors["errors"][] = $validationRule->message();
        }

        return $this->errors;
    }

    public function checkBetSlip(array $input, $validationRule)
    {
        if (!$validationRule->passes($key = "", $input)) {
            return $this->errors["errors"][] = $validationRule->message();
        }

        return $this->errors;
    }

    public function special($validationRule)
    {
        return $this->errors["errors"][] = $validationRule->message();
    }
}
