<?php

use Framework\Router;
use Framework\Database;
use Framework\Session;

require __DIR__ . '/../vendor/autoload.php';

Session::start();

require __DIR__ . '/../helpers.php';

$router = new Router();

$routes = require basePath('routes.php');
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$router->route($uri);

$config = require basePath('config/db.php');
$db = new Database($config);
