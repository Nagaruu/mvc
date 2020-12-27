<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . 'vendor/autoload.php');

use mvc\Config\core;
use mvc\Router;
use mvc\Request;
use mvc\Dispatcher;


$dispatch = new Dispatcher();
$dispatch->dispatch();
