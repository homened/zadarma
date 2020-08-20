<?php

header('Access-Control-Allow-Origin: *');  
header('Content-Type: text/html; charset=utf-8');
session_start();
define('CONSTRUCTOR_PATH', dirname(__FILE__));

require_once(CONSTRUCTOR_PATH.'/core.php');


$core = new Core(CONSTRUCTOR_PATH);
$core->connectDB();

if(isset($_GET['controller']) && !empty($_GET['controller'])) {
    if(property_exists($core->controllers, $_GET['controller'])) {
        $core->controllers->{$_GET['controller']}->show();
    } else {
        die('Контроллер не найден');
    }
} else {
    $core->controllers->auth->show();
}

?>