<?php
namespace Simfatic\Boar;

class Message
{
    public static function mustache($template, $parameters){
        return preg_replace_callback('/{{(\w+)}}/',
                function ($match) use ($parameters) 
                {
                    return isset($parameters[$match[1]]) ? $parameters[$match[1]] : $match[0];
                }, $template);
    }
        
}

