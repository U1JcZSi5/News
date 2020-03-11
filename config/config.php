<?php

// Define paths
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__))); // path to root dir 'News'
define('APP', ROOT . DS . 'app' . DS);
define('CONTROLLERS', ROOT . DS . 'app' . DS . 'controllers' . DS);
define('MODELS', ROOT . DS . 'app' . DS . 'models' . DS);
define('VIEWS', ROOT . DS . 'app' . DS . 'views' . DS);
define('LIBS', ROOT . DS . 'app' . DS . 'libs' . DS);
// URL
define('BASE_URL', 'http://localhost/Assignment/');

/* AUTOLOAD CLASSES
namespaces need to be named same as folders classes are in */
function my_autoload($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';
    $file = APP . $fileName;
    require_once $file;
}

spl_autoload_register('my_autoload');
