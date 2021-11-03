<?php

use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class AlphabeticTest extends TestCase{
    public function testValidation()
    {
        $v = Boar::create();
        $v->field("name")->alphabetic();
        $res = $v->validate(["name"=>"A12345"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        //echo " res ".json_encode($res);
        $this->assertEquals($res->errors["name"], "name can contain only alphabetic characters"); 
        
        $res = $v->validate(["name"=>"Asalkdlksajdklj"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["name"=>"Asalkdl ksajdklj"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["name"=>"A1salkdlksajdklj"]);
        $this->assertTrue($res->hasErrors());
        
        $res = $v->validate(["name"=>""]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationCustomMessage()
    {
        $v = Boar::create();
        $v->field("name")->alphabetic()->withMessage("{{field}} should be alphabetic");
        $res = $v->validate(["name"=>"A123456789012"]);
        $this->assertTrue($res->hasErrors());
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertEquals($res->errors["name"], "name should be alphabetic");
    }
    
    public function testValidationExtraCharacters()
    {
        $v = Boar::create();
        $v->field("name")->alphabetic()->withOption("extra_characters", " -.");
        $res = $v->validate(["name"=>"AAgg HHTTrr"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["name"=>"AAgg-HHT Tr.r"]);
        $this->assertFalse($res->hasErrors());
    }
    
    public function testValidationWithSpace()
    {
        $v = Boar::create();
        $v->field("name")->alphabetic()->withSpace();
        $res = $v->validate(["name"=>"AAgg HHTTrr"]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["name"=>"AAggHHTTrr"]);
        $this->assertFalse($res->hasErrors());        
        
        $res = $v->validate(["name"=>"AAggHHTTrr-"]);
        $this->assertTrue($res->hasErrors());                
        
    }
}