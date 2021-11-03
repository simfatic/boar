<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class AlphanumericTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("pincode")->alphanumeric();
        $res = $v->validate(["pincode"=>"A-12345"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["pincode"]);
        //echo " res ".json_encode($res);
        $this->assertEquals($res->errors["pincode"], "pincode can contain only alpha-numeric characters"); 
        
        $res = $v->validate(["pincode"=>"Asalkdlksajdklj"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"Asal1234kdlksajdklj"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"Asalkdl11 ksajdklj"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["pincode"=>""]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("pincode")->alphaNumeric()->withMessage("{{field}} should be alpha-numeric");
        $res = $v->validate(["pincode"=>"A--123456789012"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["pincode"]);
        $this->assertEquals($res->errors["pincode"], "pincode should be alpha-numeric");
    }
    
    public function testValidationExtraCharacters()
    {
        $v = Boar::create();
        $v->field("pincode")->alphaNumeric()->withOption("extra_characters", " -.");
        $res = $v->validate(["pincode"=>"AAgg22 HHTTrr"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"A12Agg-HHT Tr.r"]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationWithSpace()
    {
        $v = Boar::create();
        $v->field("pincode")->alphaNumeric()->withSpace();
        $res = $v->validate(["pincode"=>"11AAgg HHTTrr"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["pincode"=>"A123AggHHTTrr"]);
        $this->assertFalse($res->hasErrors());        
        
        $res = $v->validate(["pincode"=>"AAggHHTTrr-"]);
        $this->assertTrue($res->hasErrors());                
        
    }
}