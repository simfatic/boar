<?php
namespace Simfatic\Boar;

class FieldValidatorCollection
{
    public $fields;
    private $catalogue;


    public function __construct($catalogue)
    {
        $this->catalogue = $catalogue;
        $this->fields = array();
    }
    public function addField($field)
    {
        $this->fields[] = $field;
    }
    
    public function __call($function, $arguments)
    {
        if($this->catalogue->isRegistered($function))
        {
            foreach($this->fields as $field)
            {
                $field->initValidator($function, $arguments);   
            }
            return $this;
        }
        else
        {
            trigger_error('Call to undefined method '.__CLASS__.'::'.$function.'()', E_USER_ERROR);             
        }
    }

    public function withMessage(string $msg)
    {
        foreach($this->fields as $field)
        {
            $field->withMessage($msg);   
        }
        return $this;
    }
    
    public function withOption(string $name, $value)
    {
        foreach($this->fields as $field)
        {
            $field->withOption($name, $value);
        }
        return $this;
    }
    
    public function withSpace()
    {
        foreach($this->fields as $field)
        {
            $field->withSpace();
        }
        return $this;
    }
    

}