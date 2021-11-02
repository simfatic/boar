<?php
use PHPUnit\Framework\TestCase;
use Simfatic\Boar\Boar;

class CustomValidator extends Simfatic\Boar\Library\Validator
{
    public $validator_called=false;
    public function validate($field, $dataMap)
    {
        $this->validator_called=true;
        return true;
    }
}
        
class BoarTest extends TestCase{
    
    public function testSimpleValidation(){
        $v = Boar::create();
        $v->field("name")->required();
        $v->field("email")->isRequired();
        $res = $v->validate([]);
        $this->assertTrue($res->hasErrors());
        
        $this->assertNotEmpty($res->errors["name"]);
        $this->assertNotEmpty($res->errors["email"]);
    }
    
    public function testRegisterCustomValidationGetsCalled()
    {
        $v = Boar::create();
        $inst = new CustomValidator();
        $v->getCatalogue()->register("customValidation", 
            function() use($inst){ return $inst;  });
        $v->field("name")->customValidation();
        $res = $v->validate([]);
        
        $this->assertTrue($inst->validator_called);
    }
}