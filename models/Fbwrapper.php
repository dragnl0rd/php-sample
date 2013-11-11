<?php
require_once('facebook/src/facebook.php');

class Fbwrapper
{
    protected $_fb;

    public function __construct(){
        $params = array('appId'=>'126767144061773',
                        'secret'=>'21db65a65e204cca7b5afcbad91fea59');
        $this->_fb = new Facebook($params);
    }

    public function getUser(){
        $userId = $this->_fb->getUser();

        return $userId;
    }
       
}// End Partial class