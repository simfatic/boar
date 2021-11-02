<?php
namespace Simfatic\Boar;

class Result
{
    public $errors;
    public function addError($field, $err)
    {
        $this->errors[$field] = $err;
    }
    public function hasErrors()
    {
        return empty($this->errors)?false:true;
    }
}