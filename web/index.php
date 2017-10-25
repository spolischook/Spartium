<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function () {
    return '<h1>Hello World!</h1>';
});

$app->run();
