<?php
require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Database;
use Framework\Session;

Session::start();

require __DIR__ . '/../helpers.php';

require basePath('Framework/Router.php');
require basePath('Framework/Database.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router;
$routes = require basePath('routes.php');
$router->route($uri);

$config = require basePath('config/db.php');
$db = new Database($config);
