<?php 
namespace App;
class Autoloader{
    public static function register(){
        spl_autoload_register([
            __CLASS__,
            'load'
        ]);
    }

    public static function load($classe){
        $classe=str_replace(__NAMESPACE__.'\\','',$classe);
        $classe=str_replace('\\','/',$classe);
        require_once (__DIR__.'/'.$classe.'.php');
    }

}