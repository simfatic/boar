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
                        
        $catalogue->register(["number", "isNumber", "areNumbers"],
                        fn() => new Validations\Number());
                        
        $catalogue->register(["lessThan", "isLessThan", "areLessThan"],
                        fn($num) => new Validations\LessThan($num));
                        
        $catalogue->register(["lessThanOrEqualTo", "max"],
                        fn($num) => new Validations\LessThanOrEqualTo($num));
        
        $catalogue->register(["greaterThan", "isGreaterThan", "areGreaterThan"],
                        fn($num) => new Validations\GreaterThan($num));
                        
        $catalogue->register(["greaterThanOrEqualTo", "min",
                                "isGreaterThanOrEqualTo", "areGreaterThanOrEqualTo"],
                        fn($num) => new Validations\GreaterThanOrEqualTo($num)); 
                                               
        return $catalogue;            
    }
}