<?php
namespace App;

class Autoloader{

    static function autoload($class){
        $class = str_replace('\\', '/', $class);
        if(!file_exists(ROOT.'/'.$class.'.php')){
            return false;
        }else{
            include(ROOT.'/'.$class.'.php');
        }
    }

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

}