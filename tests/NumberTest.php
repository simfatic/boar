<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class NumberTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("weight")->isNumber();
        $res = $v->validate(["weight"=>"A12345"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["weight"]);
        //echo " res ".json_encode($res);
        //$this->assertEquals($res->errors["name"], "name can contain only alphabetic characters"); 
        
        $res = $v->validate(["weight"=>"123ttytyt"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["weight"=>"123.223"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["weight"=>"123.223.22"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["weight"=>""]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
    }
    
    
}