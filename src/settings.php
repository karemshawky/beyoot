<?php
date_default_timezone_set('Asia/Riyadh');

define('UrlPath', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define('BaseUrl', 'http://localhost/beyoot/');
define('BackEndUrl', BaseUrl . 'templates/backend/');
define('FrontEndUrl', BaseUrl . 'templates/frontend/');
define('AdminPanel', BaseUrl . 'admin-panel/');
define('IMG', BaseUrl . 'uploads/img/');

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true,

        // App
        'app' => [
            'env' => 'dev',
            'key' => '?0x2np@k9lk@m0',
        ],

        // Monolog
        'logger' => [
            'name' => 'api',
            'path' => __DIR__ . '/../logs/' . date('Y-m-d') . '.log',
        ],

        // Router
        'router' => [
            'public'
        ],
    ],
];
