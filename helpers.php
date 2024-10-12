<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = "")
{
    return __DIR__ . '/' . $path;
}


/**
 * Load a view
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
        echo "View {$name} not found.";
    }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name)
{
    $partialPath = basePath("views/partials/{$name}.php");

    // Make sure path exists
    if ($partialPath) {
        require $partialPath;
    } else {
        echo "Partia {$name} not found.";
    }
}
