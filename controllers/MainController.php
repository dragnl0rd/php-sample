<?php

class MainController extends Controller {

    public function init(){
    }
    
    public function indexAction(){
        $this->_view->addScript('test-links');            
    }
}
