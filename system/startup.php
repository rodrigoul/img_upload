<?php

function startup()
{
	global $config;
    
    // Set our defaults
    $controller = $config['default_controller'];
    $action = 'index';
    $url = '';
	
	// Get request url and script url
	$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
	$url = trim(str_replace('/img_upload/index.php', '', $request_url));
    
	// Split the url into segments
	$segments = explode('/', $url);
	// Do our default checks
	if(isset($segments[0]) && $segments[0] != '') $controller = $segments[0];
	if(isset($segments[1]) && $segments[1] != '' && (strpos($segments[1], '?') === false) ) $action = $segments[1];
    
    $app_dir  = str_replace('\\', '/', APP_DIR);

    // Get our controller file
    foreach ($config['autoload'] as $name ) {
        require($app_dir .'plugins/'. strtolower($name) .'.php');
    }

    $path =   $app_dir . 'controllers/' . $controller . '.php';


    if(file_exists($path)){
        require_once($path);
	}else {
        $controller = $config['error_controller'];
        require_once($app_dir . 'controllers/' . $controller . '.php');
	}

    // Check the action exists
    if(!method_exists($controller, $action)){

    var_dump($controller);
    var_dump($action);
        $controller = $config['error_controller'];
        require_once($app_dir . 'controllers/' . $controller . '.php');
        //$action = 'index';
    }
	// Create object and call method
	$obj = new $controller;

    die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));

}

?>
