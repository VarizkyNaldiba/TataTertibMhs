<?php
<<<<<<< HEAD
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
=======
session_start();
// require_once '../Controllers/UserController.php';

// if (isset($_GET['logout'])) {
//     $userController = new UserController();
//     $userController->logout();
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>

    <?php
    include 'views/homepage.php';
    ?>

    <script src="../js/script.js">
    </script>
</body>

</html>
>>>>>>> 71f1ac10d88a0516784951ed11ad45df402e0dca
