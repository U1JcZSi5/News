<?php

use controllers\RegisterController;

require_once '../config/config.php';
require_once '../config/functions.php';

$app = new \libs\App($_SERVER['REQUEST_METHOD']);
$app->startApp();
