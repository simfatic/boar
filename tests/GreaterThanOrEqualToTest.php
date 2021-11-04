<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class GreaterThanOrEqualToTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("weight")->isGreaterThanOrEqualTo(12);
        $res = $v->validate(["weight"=>"11"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["weight"]);
        $this->assertEquals($res->errors["weight"], "weight should be greater than or equal to 12"); 
        
        $res = $v->validate(["weight"=>"13"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12.1"]);
        $this->assertFalse($res->hasErrors());
    }
    public function testValidationMin()
    {
        $v = Boar::create();
        $v->field("weight")->min(12);
        $res = $v->validate(["weight"=>"11"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"11.9"]);
        $this->assertTrue($res->hasErrors());
    }
    
}