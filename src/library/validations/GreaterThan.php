<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class GreaterThan extends Validator
{
    public float $num = 0;
    public $message = "{{field}} should be greater than {{num}}";
    
    public function __construct(float $num)
    {
        $this->num = $num;
    }
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return true;
        }
        
        return ( ((float) ($post[$field])) > $this->num );
    }
}