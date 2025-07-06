<?php

require_once __DIR__ . '/connection/connection.php';
require_once __DIR__ . '/models/Movie.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/services/ResponseService.php';
require_once __DIR__ . '/controllers/BaseController.php';
require_once __DIR__ . '/controllers/MovieController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/routes/apis.php';

$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($request, $base_dir) === 0) {
    $request = substr($request, strlen($base_dir));
}

if ($request == '') {
    $request = '/';
}

if (isset($apis[$request])) {
    $controller_name = $apis[$request]['controller'];
    $method = $apis[$request]['method'];
    require_once "controllers/{$controller_name}.php";

    $controller = new $controller_name();
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Error: Method {$method} not found in {$controller_name}.";
    }
} else {
    echo "404 Not Found";
}

?>