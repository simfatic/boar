<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class MinLength extends Validator
{
    public int $min_length = 0;
    public $message = "{{field}} should be at least {{min_length}} characters long";
    
    public function __construct(int $min_length)
    {
        $this->min_length = $min_length;
    }
    
    public function validate($field, $post)
    {
        if(!isset($post[$field]))
        {
            return true;
        }
        
        return (strlen($post[$field]) >= $this->min_length) ? true:false;
    }
}