<?php
namespace Simfatic\Boar;

class FieldValidator
{   
    private $field_name;
    private $validators;
    private $catalogue;

    public function __construct($catalogue, $field_name)
    {
        $this->catalogue = $catalogue;
        $this->field_name = $field_name;
        $this->validators = [];
    }
    public function __call($function, $arguments)
    {
        if($this->catalogue->isRegistered($function))
        {
            $this->validators[$function] =  
                $this->catalogue->createValiator($function, $arguments);
        }
        else
        {
            trigger_error('Call to undefined method '.__CLASS__.'::'.$function.'()', E_USER_ERROR);         
        }
    }
    
    public function validate($post)
    {
        foreach($this->validators as $val => $validator)
        {
            $ret = $validator->validate($this->field_name, $post);
            if($ret === false)
            {
                return $validator->message;
            }
        }
        return true;
    }
    
    

}
