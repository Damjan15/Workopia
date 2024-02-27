<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a View
 * 
 * @param string $name
 * @param array $data
 * @return void
 */
function loadView($name)
{
    require basePath("views/{$name}.view.php");
}

/**
 * Load a Partial
 * 
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name)
{
    require basePath("views/partials/{$name}.php");
}
