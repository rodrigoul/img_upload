<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('default_charset','UTF-8');
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');  

//Start the Session
session_start(); 
// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');

$root_dir 	= str_replace('\\', '/', ROOT_DIR);
$app_dir 	= str_replace('\\', '/', APP_DIR);

// $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
// $base_url = ($https ? 'https://' : 'http://'). (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : ''). (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME']. ($https && $_SERVER['SERVER_PORT'] === 443 || $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))). substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/')) . '/';

$base_url = 'http://localhost/upload/';
define('BASE_URL', $base_url);
// Includes
require($app_dir .'config/config.php');
require($root_dir .'system/model.php');
require($root_dir .'system/view.php');
require($root_dir .'system/controller.php');
require($root_dir .'system/startup.php');

// Define base URL
global $config;

/*if (!function_exists('ftp_ssl_connect')) {
    echo "FTP functions are not available on this server.<br />\n";
}
if (!is_writable($_SERVER['DOCUMENT_ROOT'].'/'.$config['filepath'].'/')) {
    echo "'files' folder are not available for write, please check permissions.<br />\n";
}*/

startup();

?>
