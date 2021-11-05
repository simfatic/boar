<?php
namespace Simfatic\Boar;

class FieldValidator
{   
    private $field_name;
    private $validators;
    private $catalogue;
    private $last_validator;

    public function __construct($catalogue, $field_name)
    {
        $this->catalogue = $catalogue;
        $this->field_name = $field_name;
        $this->validators = [];
        $this->last_validator = "";
        
    }
    
    public function __call($function, $arguments)
    {
        if($this->catalogue->isRegistered($function))
        {
            $this->initValidator($function, $arguments);
        }
        else
        {
            trigger_error('Call to undefined method '.__CLASS__.'::'.$function.'()', E_USER_ERROR);         
        }
        return $this;
    }
    
    public function initValidator($function, $arguments)
    {
        $this->validators[$function] =  
                $this->catalogue->createValiator($function, $arguments);
        $this->last_validator = $function;
    }
    
    public function withMessage(string $msg)
    {
        if(!empty($this->last_validator))
        {
            if(isset($this->validators[$this->last_validator]))
            {
                $this->validators[$this->last_validator]->message = $msg;
            }
        }
        return $this;
    }
    
    public function withOption(string $name, $value)
    {
        if(!empty($this->last_validator))
        {
            if(isset($this->validators[$this->last_validator]))
            {
                $this->validators[$this->last_validator]->$name = $value;
            }
        }
        return $this;
    }
    
    public function withSpace()
    {
        if(!empty($this->last_validator))
        {
            if(isset($this->validators[$this->last_validator]))
            {
                $this->validators[$this->last_validator]->extra_characters .= " ";
            }
        }
        return $this;
    }
    
    public function validate($post)
    {
        foreach($this->validators as $val => $validator)
        {
            $ret = $validator->validate($this->field_name, $post);
            if($ret === false)
            {
                return $this->formatMessage($this->field_name, $validator);
            }
        }
        return true;
    }
    
    private function formatMessage($field_name, $validator)
    {
        $params = array_merge(["field"=>$field_name], (array)$validator);
        
        return Message::mustache($validator->message, $params);
    }

}
