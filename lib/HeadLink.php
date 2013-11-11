<?php

class HeadLink extends AbstractHead{
    protected $_cssFiles;
    
    public function __construct(){
        $this->_cssFiles = array();
    }
    
    public function add($fileName){
        $this->_cssFiles[] = $fileName;
    }
    
    public function __toString(){
        $temp = "";
        foreach($this->_cssFiles as $key=>$fileName){
            $temp .= <<<EOT
            <link rel="stylesheet" type="text/css" href="/assets/css/{$fileName}.css" />
            
EOT;

        }
    }
}