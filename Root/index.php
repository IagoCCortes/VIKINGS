<?php
ini_set('max_execution_time', 0);
define('WEBROOT', str_replace("Root/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Root/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
require_once '../vendor/autoload.php';
require(ROOT . 'Config/core.php');
require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');
$dispatch = new Dispatcher();
$dispatch->dispatch();
?>