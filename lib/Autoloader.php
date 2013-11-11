<?php

/**
* taken from devshed.
* @author Alejandro Gervasio
*/

class Autoloader
{
    private static $_instance;
    
    // get the Singleton instance of the autoloader
    public static function getInstance()
    {
       if (!self::$_instance) {
           self::$_instance = new self;
       }
       return self::$_instance; 
    }
    
    // private constructor
    private function __construct()
    {
        spl_autoload_register(array($this, 'load'));  
    }
    
    // prevent cloning instance of the autoloader
    private function __clone(){}
     
    // autoload classes on demand 
    public static function load($class)
    {
        //inflect the class name to find it.
        $arrPath = explode("_", $class);
        $file = "";
        $className = "";
        do{
            $slug = current($arrPath);
            if(key($arrPath) != count($arrPath) - 1){
                $file .= strtolower($slug) . "/";    
            }else{
                $file .= ucwords($slug) . ".php";
            }
            
        }while(next($arrPath));
        
        try{
            require_once $file;
        }catch(Exception $e){
            throw new ClassNotFoundException('The file ' . $file . ' containing the requested class ' . $class . ' was not found.');    
        }    
        
        unset($file);
        
        if (!class_exists($class, false)) {
            throw new ClassNotFoundException('The requested class ' . $class . ' was not found.');
        }
        
    }   
}// End Autoloader class



class ClassNotFoundException extends Exception{}