<?php

foreach (glob( __DIR__ . "/../src/middlewares/*.php") as $filename)
{
   require_once $filename;
}

// Logger
$app->add(new Middlewares\Logger(
    $container->get('logger'),
    $container
));

// Basic Auth
$app->add( new Slim\Middleware\HttpBasicAuthentication ([
    "path" => "/apis", /* or ["/admin", "/api"] */
    "realm" => "Protected",
    "secure" => false,
    // "secure" => true,
    // "relaxed" => ["localhost", "dev.example.com"],
    "authenticator" => new Middlewares\BasicAuth()
]));