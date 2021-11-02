<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class Required extends Validator
{
    public $message = "The field is required";
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return false;
        }
        
        $value = trim($post[$field]);

        if(empty($value))
        {
            return false;
        }
        
        return true;
    }
}