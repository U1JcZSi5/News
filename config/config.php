<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__))); // path to root dir 'News'
define('APP', ROOT . DS . 'app' . DS);
define('CONTROLLERS', ROOT . DS . 'app' . DS . 'controllers' . DS);
define('MODELS', ROOT . DS . 'app' . DS . 'models' . DS);
define('VIEWS', ROOT . DS . 'app' . DS . 'views' . DS);
define('LIBS', ROOT . DS . 'app' . DS . 'libs' . DS);
define('IMAGES', 'http://192.168.0.14/news/images/');
define('BASE_URL', 'http://192.168.0.14/news/public/index.php?');

// namespaces need to be named same as folders classes are in
function my_autoload($className)
{
    $fileName = str_replace('\\', '/', $className) . '.php';
    $file = APP . $fileName;
    require_once $file;
}

spl_autoload_register('my_autoload');
