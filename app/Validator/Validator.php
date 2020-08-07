<?php

namespace App\Validator;

class Validator
{
    protected $errors = [];
    protected $arrErrors = [];

    public function make(array $input = [], array $rules = [])
    {
        if ($input && $rules) {
            foreach ($input as $key => $val) {
                if (is_array($val)) {
                    $this->errors[$key] = $this->validateArrays($val, $rules, $input);
                }

                foreach ($rules[$key] as $validationRule) {
                    if(! $validationRule->passes($key, $val)){
                        $this->errors['errors'][] = $validationRule->message();
                    }
                }
            }
        }

        return $this->errors;
    }

    public function validateArrays(array $input, array $rules, $parentArray = [])
    {
        if($input && $rules){
            foreach ($input as $key => $val) {
                if(is_array($val)){
                    $this->validateArrays($val, $rules, $val);
                }

                if(array_key_exists($key, $rules)){
                     foreach ($rules[$key] as $validationRule) {
                         if(! $validationRule->passes($key, $val, $input)){
                             $this->arrErrors[] = $validationRule->message($parentArray);
                         }
                    }
                 }
            }
        }

        return $this->arrErrors;
    }
}
