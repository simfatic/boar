<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class Email extends Validator
{
    public $message = "{{field}} must be a valid email address";
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return true;
        }
        
        return (filter_var($post[$field] , FILTER_VALIDATE_EMAIL) === false)?false:true;
    }
}