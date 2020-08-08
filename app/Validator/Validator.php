<?php

namespace App\Validator;

class Validator
{
    protected $errors = [];
    protected $localErrors = [];

    public function global(array $input = [], array $rules = [])
    {
        if ($input && $rules) {
            foreach ($input as $key => $val) {
                if(array_key_exists($key, $rules)) {
                    foreach ($rules[$key] as $validationRule) {
                        if (!$validationRule->passes($key, $val)) {
                            $this->errors[] = $validationRule->message();
                        }
                    }
                }
            }
        }

        return $this->errors;
    }

    public function local(array $input, array $rules, $parentArray = [])
    {
        if($input && $rules){
            foreach ($input as $key => $val) {
                if(is_array($val)){
                    $this->local($val, $rules, $val);
                }

                if(array_key_exists($key, $rules)){
                     foreach ($rules[$key] as $validationRule) {
                         if(! $validationRule->passes($key, $val)){
                             $this->localErrors[] = $validationRule->message($parentArray);
                         }
                    }
                 }
            }
        }

        return $this->localErrors;
    }

    public function checkWin(array $input, $validationRule)
    {
        if(! $validationRule->passes($key = "",  $input)){
            return $this->errors = $validationRule->message();
        }

        return $this->errors;
    }
}
