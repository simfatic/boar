<?php
use PHPUnit\Framework\TestCase;

use Simfatic\Boar\Message;

class MessageTest extends TestCase{
    
    public function testMessageInterpolation()
    {
        $res = Message::mustache("{{field}} is required", ["field"=>"name"]);
        #echo "\nmessage updated\n $res";
        $this->assertEquals($res, "name is required");
        
        $res = Message::mustache("{{field}} is required", []);
        
        $this->assertEquals($res, "{{field}} is required");
        
        $res = Message::mustache("{{field}} shouldn't exceed max length of {{len}}", ["field"=>"name", "len"=>100]);
        
        $this->assertEquals($res,"name shouldn't exceed max length of 100");
        
    }
}