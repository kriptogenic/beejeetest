<?php

define('BASE_DIR', __DIR__ . '/../');
define('APP_DIR', BASE_DIR . 'app/');
define('BASE_URI', '/public');

require BASE_DIR . 'vendor/autoload.php';

$config = require BASE_DIR . 'config.php';
$app = new \App\Kernel($config);
$app->run();
