<?php

if (PHP_SAPI == 'cli-server') {
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . 'vendor/autoload.php';

session_start();

if (isset($_SESSION['userid'])) {
    $_SESSION['userid'] = $_SESSION['userid'];
} else {
    $_SESSION['userid'] = 0;
}

require __DIR__ . 'src/cors.php';

$settings = require __DIR__ . 'src/settings.php';

$app = new \Slim\App($settings);

require __DIR__ . 'src/dependencies.php';

require __DIR__ . 'src/middleware.php';

require __DIR__ . 'src/routes.php';

$app->run();
