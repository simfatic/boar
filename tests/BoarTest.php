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
        $this->assertEquals($res->errors["name"], "name is required");
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
    
    public function testMultipleFieldsValidation()
    {
        $v = Boar::create();
        $v->fields(["name","email","message"])->areRequired()->withMessage("{{field}} can't be left empty!");
        $res = $v->validate([]);
        //echo "res ".json_encode($res);
        $this->assertTrue($res->hasErrors());
        $this->assertEquals($res->errors["email"],"email can't be left empty!");
        $this->assertEquals($res->errors["name"],"name can't be left empty!");
        $this->assertEquals($res->errors["message"],"message can't be left empty!");
    }
    
    public function testMultipleFieldsWithOptions()
    {
        $v = Boar::create();
        $v->fields(["first_name","last_name"])->alphabetic()->withSpace()->withMessage("{{field}} can contail alphabetic characters and spaces only!");
        $res = $v->validate([]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["first_name"=>"some name here","last_name"=>"another name " ]);
        $this->assertFalse($res->hasErrors());
        
        $res = $v->validate(["first_name"=>"some 79879","last_name"=>"another 978798" ]);
        //echo "res ".json_encode($res);
        $this->assertTrue($res->hasErrors());
        $this->assertEquals($res->errors["first_name"],"first_name can contail alphabetic characters and spaces only!");
        $this->assertEquals($res->errors["last_name"],"last_name can contail alphabetic characters and spaces only!");
    }
}