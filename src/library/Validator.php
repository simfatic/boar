<?php
namespace Simfatic\Boar\Library;

abstract class Validator
{
    abstract public function validate($field, $dataMap);
}