<?php

$routes = require('routes.php');

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    require $routes['404'];
}
