<?php

require_once '../config/config.php';
require_once '../config/functions.php';

$route = $_GET['route'] ?? 'home';

$app = new \libs\App($_SERVER['REQUEST_METHOD'], $route);
$app->startApp();
