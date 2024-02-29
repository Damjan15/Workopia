<?php

namespace App\Controllers;

class ErrorController
{
    /**
     * 404 Not Found Error
     * 
     * @param string $message
     * @return void
     */
    public static function notFound($message = "Resource Not Found")
    {
        http_response_code('404');
        loadView('error', [
            'status' => '404',
            'message' => $message,
        ]);
    }

    /**
     * 403 Unauthorized Error
     * 
     * @param string $message
     * @return void
     */
    public static function unauthorized($message = "You are unauthorized to access this resource")
    {
        http_response_code('403');
        loadView('error', [
            'status' => '403',
            'message' => $message,
        ]);
    }
}
