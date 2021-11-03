<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class DigitsOnly extends Validator
{
    public $message = "{{field}} can contain only digits (0-9)";
    public $extra_characters ="";
    
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return true;
        }
        
        $value = str_replace(str_split($this->extra_characters), '', $post[$field]);
        return ctype_digit($value);
    }
}