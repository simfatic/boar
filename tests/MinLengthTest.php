<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class MinLengthTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("name")->minLength(5);
        $res = $v->validate(["name"=>"A123"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertEquals($res->errors["name"], "name should be at least 5 characters long"); 
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("name")->minLength(6)->withMessage("name is too short");
        $res = $v->validate(["name"=>"A123"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertEquals($res->errors["name"], "name is too short");
    }
}