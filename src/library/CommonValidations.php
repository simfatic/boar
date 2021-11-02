<?php
namespace Simfatic\Boar\Library;

class CommonValidations
{
    public static function catalogue()
    {
        $catalogue = new Catalogue();
        $catalogue->register(["required", "areRequired", "isRequired"],
                        fn() => new Validations\Required());
        
        $catalogue->register(["maxLength", "maxLen"],
                        fn($maxlen) => new Validations\MaxLength($maxlen));
        
        return $catalogue;            
    }
}