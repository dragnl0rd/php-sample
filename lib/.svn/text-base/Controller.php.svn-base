<?php

class Controller
{
    protected $_view;
    
    public function __construct(){
        $this->_view = new View();
        $this->_view->jsFiles = array();
        $this->_view->cssFiles = array();
    }
    
    public function __call($name, $args){
        $method = $name."Action";
        if(!method_exists($this, $method)){
            throw new ActionNotFoundException("No method found in " . get_class($this) . " controller by the name of " . $method);                
        }
        $defaultViewPath = "/scripts/" . strtolower(get_class($this)). "/" . $name;

        $this->_view->addView(new Partial($defaultViewPath));
        $this->$method();
        
    }
    
    public function init(){
    } 
    
    public function preDispatch(){
    }
     
    public function postDispatch(){
    }
    
    public function __destruct(){
        echo $this->_view->render();
    }
}//end class AbstractController

class ActionNotFoundException extends Exception{};
