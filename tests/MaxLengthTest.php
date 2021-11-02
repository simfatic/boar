<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class MaxLengthTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("name")->maxLength(12);
        $res = $v->validate(["name"=>"A123456789012"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertEquals($res->errors["name"], "name exceeded max length 12"); 
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("name")->maxLength(10)->withMessage("name should be shorter than {{max_length}}");
        $res = $v->validate(["name"=>"A123456789012"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertEquals($res->errors["name"], "name should be shorter than 10");
    }
}