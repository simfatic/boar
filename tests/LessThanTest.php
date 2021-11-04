<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class LessThanTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("weight")->isLessThan(12);
        $res = $v->validate(["weight"=>"14"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["weight"]);
        $this->assertEquals($res->errors["weight"], "weight should be less than 12"); 
        
        $res = $v->validate(["weight"=>"11"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"12"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["weight"=>"11.9"]);
        $this->assertFalse($res->hasErrors());
    }
    
    
}