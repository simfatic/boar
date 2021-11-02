<?php
namespace Simfatic\Boar\Library;

class Catalogue
{
    private $collection = [];
    public function __construct()
    {
        $this->collection = [];
    }
    
    public function register($names, $factoryFn )
    {
        if(is_array($names) )
        {
          foreach($names as $name){
            $this->collection[$name] = $factoryFn;      
          }  
        }else{
            $this->collection[$names] = $factoryFn;    
        }
        return $this;
    }
    public function isRegistered(string $name):bool
    {
        return isset($this->collection[$name]);
    }
    public function createValiator(string $name, $arguments)
    {
        return $this->collection[$name](...$arguments);
    }
}

