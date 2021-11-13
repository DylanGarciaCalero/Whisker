<?php

require 'app.php';


function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$route = explode('/', strtolower($_SERVER['REQUEST_URI']));

//remove first empty element;
array_shift($route);

$controller = 'Home';
$method = 'index';
$params = [];

if(isset($route[0]) && $route[0] != '') {
    $controller = ucfirst(array_shift($route));

    if(isset($route[0])) {
        $method = array_shift($route);  
    }

    $params = $route;
} 

$controller_path =  BASE_DIR . '/controllers/' . $controller . '.php';
if(!file_exists($controller_path)) {
    echo 'TODO: 404 inladen';
    exit;
} 

ob_start();

require_once $controller_path;

$controller_name = $controller . 'Controller';
$controller = new $controller_name();
$controller->{$method}($params);

$content = ob_get_contents();
ob_end_clean();

include 'views/_templates/main.php';

