<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class LessThanOrEqualToTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("weight")->lessThanOrEqualTo(12);
        $res = $v->validate(["weight"=>"14"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["weight"]);
        $this->assertEquals($res->errors["weight"], "weight should be less than or equal to 12"); 
        
        $res = $v->validate(["weight"=>"11"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"11.9"]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationMax()
    {
        $v = Boar::create();
        $v->field("weight")->max(12);
        $res = $v->validate(["weight"=>"14"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["weight"]);
        $this->assertEquals($res->errors["weight"], "weight should be less than or equal to 12"); 
        
        $res = $v->validate(["weight"=>"11"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12"]);
        $this->assertFalse($res->hasErrors());
    }
    
    
}