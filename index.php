<?php

/**
 * debug/test code.
 */
//var_dump($_SERVER);die();
//
//$_REQUEST['signed_request'] = 'cjv1NZlSRCthYq9rAyWEidD7QE98p0PKZvVwpQ7gPwg.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzMjI4NTYwMDAsImlzc3VlZF9hdCI6MTMyMjg1MDc1NCwib2F1dGhfdG9rZW4iOiJBQUFCelMwYVhTMDBCQUlob0I1bmhrYnZJU0xLSGpNb3ZIN2ZTTmMzWkFxbnVNT2NvYmpJUHoxNGFmWXV1dzBkbkZzeVpBV2JHU2MycXZBakdjRzZUQ1RWZzBLOUVGUWJ5WkJwNTU0ZXE5M2FTWkFXZXpVeEYiLCJ1c2VyIjp7ImNvdW50cnkiOiJ1cyIsImxvY2FsZSI6ImVuX1VTIiwiYWdlIjp7Im1pbiI6MjF9fSwidXNlcl9pZCI6IjEwMDAwMzI5MTY2MTkwOSJ9';
/*$sortable = array(7,4,6,1,341);
arsort($sortable);
var_dump($sortable);die();*/
  
/**
* @todo make a bootstrap.
*/

defined('APP_PATH')
    or define('APP_PATH', __DIR__);
defined('LIB_PATH')
    or define('LIB_PATH', APP_PATH . "/lib");
defined('CONTROLLER_PATH')
    or define('CONTROLLER_PATH', APP_PATH . "/controllers");
defined('MODEL_PATH')
    or define('MODEL_PATH', APP_PATH . "/models");
defined('VIEW_PATH')
    or define('VIEW_PATH', APP_PATH . "/views");

set_include_path(
    get_include_path() . PATH_SEPARATOR  
    . LIB_PATH . PATH_SEPARATOR
    . CONTROLLER_PATH . PATH_SEPARATOR
    . MODEL_PATH . PATH_SEPARATOR
    . VIEW_PATH . PATH_SEPARATOR
);


require_once "Autoloader.php";

$autoloader = Autoloader::getInstance();

$path = $_SERVER['REQUEST_URI'];

$uriSections = explode('?', $path);
$route = $uriSections[0];

$routerChunks = explode('/', $route);
array_shift($routerChunks);

$controller = false;
$action = false;
$params = array();
$settingParam = false;
foreach($routerChunks as $key=>$chunk){
    if($settingParam){
        $settingParam = false;
        continue;
    }
    if(!$chunk){
        continue;
    }

    if(!$controller){
        $controller = $chunk . "Controller";
        continue;
    }

    if(!$action){
        $action = $chunk;
        continue;
    }

    if(isset($routerChunks[$key+1])){
        $params[$chunk] = $routerChunks[$key+1];

        if(isset($routerChunks[$key+2])){
            $settingParam = true;
            continue;    
        } else{
            break;
        }
        
        
    } else {
        $params[$chunk] = null;    
    }
    

}

foreach($params as $key=>$val){
    $_REQUEST[$key]=$val;
    $_GET[$key]=$val;
}

if(!$controller){
    $controller = new MainController;        
} else {
    $controller = new $controller;
}

$controller->init();
$controller->preDispatch();

if(!$action){
    $controller->index();
} else {
    $controller->{$action}();
}

$controller->postDispatch();
