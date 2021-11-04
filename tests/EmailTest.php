<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class EmailTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("email")->email();
        $res = $v->validate(["email"=>"A12345"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["email"]);
        
        $this->assertEquals($res->errors["email"], "email must be a valid email address"); 
        
        $res = $v->validate(["email"=>"abcd@slkjlksj.cc"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["email"=>"abcd@123slkjlksj.travel"]);
        $this->assertFalse($res->hasErrors());        
        
        $res = $v->validate(["email"=>""]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("email")->isEmail()->withMessage("{{field}} should be a valid email address");
        $res = $v->validate(["email"=>"A123"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["email"]);
        $this->assertEquals($res->errors["email"], "email should be a valid email address");
    }
    
    
}