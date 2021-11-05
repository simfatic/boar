<?php
namespace Simfatic\Boar;


class Boar
{
    private $fields;
    private $catalogue;

    public function __construct()
    {
        $this->fields = array();
        $this->catalogue = Library\CommonValidations::catalogue();
    }

    public static function create()
    {
        return new Boar();
    }
    
    public function getCatalogue()
    {
        return $this->catalogue;
    }
    
    public function field($field_name)
    {
        if(isset($this->fields[$field_name]))
        {
            return $this->fields[$field_name];
        }

        $field = new FieldValidator($this->catalogue, $field_name);

        $this->fields[$field_name] = $field;

        return $field; 
    }
    
    public function fields($arr_fields)
    {
        $fc = new FieldValidatorCollection($this->catalogue);
        foreach($arr_fields as $field)
        {
            $fc->addField($this->field($field));
        }
        return $fc;
    }
    
    public function validate($post)
    {
        $result = new Result();
        foreach($this->fields as $field => $fv)
        {
            $res = $fv->validate($post);
            if($res !== true)
            {
                $result->addError($field, $res);
            }
        }
        
        return $result;
    }
    
}