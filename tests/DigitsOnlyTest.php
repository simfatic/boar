<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class DigitsOnlyTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("pincode")->digitsOnly();
        $res = $v->validate(["pincode"=>"A12345"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["pincode"]);
        //echo " res ".json_encode($res);
        $this->assertEquals($res->errors["pincode"], "pincode can contain only digits (0-9)"); 
        
        $res = $v->validate(["pincode"=>"5165116554990"]);
        $this->assertFalse($res->hasErrors());
                
        $res = $v->validate(["pincode"=>"12345 627627"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["pincode"=>""]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("pincode")->digits()->withMessage("{{field}} should be digits only");
        $res = $v->validate(["pincode"=>"a123456789012"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["pincode"]);
        $this->assertEquals($res->errors["pincode"], "pincode should be digits only");
    }
    
    public function testValidationExtraCharacters()
    {
        $v = Boar::create();
        $v->field("pincode")->digitsOnly()->withOption("extra_characters", " -.");
        $res = $v->validate(["pincode"=>"123 345"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"7787-8989. 00"]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationWithSpace()
    {
        $v = Boar::create();
        $v->field("pincode")->digitsOnly()->withSpace();
        $res = $v->validate(["pincode"=>"6677 7766"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"  88  00 99  "]);
        $this->assertFalse($res->hasErrors());        
        
        $res = $v->validate(["pincode"=>"1234-90"]);
        $this->assertTrue($res->hasErrors());                
        
    }
}