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
    $viewPath = basePath("views/{$name}.view.php");

    // Make sure path exists
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View '{$name}' not found.";
    }
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
    $partialPath = basePath("views/partials/{$name}.php");

    // Make sure path exists
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found.";
    }
}
