<?php
class HeadScript extends AbstractHead{
    protected $_jsFiles;
    
    public function __construct(){
        $this->_jsFiles = array();
    }
    
    public function add($fileName){
        $this->_jsFiles[] = $fileName;
    }
    
    public function __toString(){
        $temp = "";
        foreach($this->_jsFiles as $key=>$fileName){
            $temp .= <<<EOT
<script type="text/javascript" src="/assets/js/{$fileName}.js"></script>
            
EOT;

        }
        return $temp;
    }
}


