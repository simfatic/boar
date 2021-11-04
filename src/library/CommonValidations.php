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
                        
        $catalogue->register(["minLength", "minLen"],
                        fn($minlen) => new Validations\MinLength($minlen));        
                        
        $catalogue->register(["alphabetic"],
                        fn() => new Validations\Alphabetic());
                        
        $catalogue->register(["email", "isEmail", "areEmails"],
                        fn() => new Validations\Email());                        
                        
        $catalogue->register(["alphanumeric", "alpha_numeric","alphaNumeric"],
                        fn() => new Validations\AlphaNumeric());
                        
        $catalogue->register(["digits", "digitsOnly"],
                        fn() => new Validations\DigitsOnly());
                        
        return $catalogue;            
    }
}