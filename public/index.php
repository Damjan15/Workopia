<?php

require '../helpers.php';

require basePath('Router.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router;
$routes = require basePath('routes.php');
$router->route($uri, $method);
