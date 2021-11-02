<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class MaxLength extends Validator
{
    public int $max_length = 0;
    public $message = "{{field}} exceeded max length {{max_length}}";
    
    public function __construct(int $max_length)
    {
        $this->max_length = $max_length;
    }
    
    public function validate($field, $post)
    {
        if(!isset($post[$field]))
        {
            return true;
        }
        
        return (strlen($post[$field]) <= $this->max_length) ? true:false;
    }
}