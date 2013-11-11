<?php

class ApiController extends Controller {

	protected $_method;

    public function init(){
    	$this->_view->setTemplate("rest");

    	$this->_method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function indexAction(){
        
    }

    public function userAction(){
    	$target = $this->_method . 'User';
    	$this->{$target}();
    }

    protected function getUser(){
    	$facebook = new Fbwrapper();
    	$facebook->getUser();
    }


}
