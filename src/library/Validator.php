<?php
namespace Simfatic\Boar\Library;

abstract class Validator
{
    public $message = "";
    abstract public function validate($field, $dataMap);
    
}