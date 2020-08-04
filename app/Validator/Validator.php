<?php

namespace App\Validator;

class Validator
{
    protected $val = 101;
    protected $errors = [];

    public function make(array $input = [], array $rules = [])
    {
        if($input && $rules){
            foreach ($input as $key => $val) {
                if(is_array($val) && array_key_exists($key, $rules){
                    foreach ($rules[$key] as $validationRule){

                    }
                    $this->errors[$key] = $this->validateArray($val, $rules);
                }

//                if(array_key_exists($key, $rules)){
//                    foreach ($rules[$key] as $validationRule) {
//                        if(! $validationRule->passes($key, $val)){
//                            if($name){
//                                $this->errors[$name] = $validationRule->message();
//                            }else{
//                                $this->errors[] = $validationRule->message();
//                            }
//                        }
//                    }
//                }



            }
        }
    }

    public function validateArray(array $input, array $rules)
    {
        if($input && $rules){
            foreach ($input as $key => $val) {
                if(array_key_exists($key, $rules)){
                     foreach ($rules[$key] as $validationRule) {
                         if(! $validationRule->passes($key, $val)){
                             if($name){
                                 $this->errors[$name] = $validationRule->message();
                             }else{
                                 $this->errors[] = $validationRule->message();
                             }
                         }
                    }
                 }
            }
        }

        return $this->errors;
    }
}
