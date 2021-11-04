<?php
namespace Simfatic\Boar\Library\Validations;

use Simfatic\Boar\Library\Validator;

class Number extends Validator
{
    public $message = "{{field}} should be a number";
    
    public function validate($field, $post)
    {
        if(empty($post[$field]))
        {
            return true;
        }
        $vv = $post[$field];
        $rr = (float) ($post[$field]);
        
        if( "$rr" === "$vv" )
        {
            return true;
        }
        return false;
        //return !is_nan( $rr );
    }
}