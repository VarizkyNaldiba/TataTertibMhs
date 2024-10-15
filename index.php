<?php
require_once 'config/database.php';
require_once 'controllers/TatibController.php';

// Function to handle routing
function route($request)
{
    // Strip query parameters for routing
    $route = strtok($request, '?');

    switch ($route) {
        case '':
        case 'home':
            include 'views/Home.php';
            break;
        case 'tataTertib':
            // Call the controller for tataTertib route
            $controller = new TatibController();
            $controller->index();
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
            break;
    }
}

// Get the request path without sanitization
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Route the request
route($request);
