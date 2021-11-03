<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class AlphaNumeric extends Validator
{
    public $message = "{{field}} can contain only alpha-numeric characters";
    public $extra_characters ="";
    
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return true;
        }
        
        $value = str_replace(str_split($this->extra_characters), '', $post[$field]);
        return ctype_alnum($value);
    }
}