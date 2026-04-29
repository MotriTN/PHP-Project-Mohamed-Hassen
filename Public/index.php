<?php

declare(strict_types=1);

// Enable error reporting for development
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start session securely
session_start();

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('CONTROLLERS_PATH', BASE_PATH . '/Controllers');
define('MODELS_PATH', BASE_PATH . '/Models');
define('VIEWS_PATH', BASE_PATH . '/Views');

// Simple Autoloader (can be replaced by Composer later if needed, but strict constraint says no Composer)
spl_autoload_register(function ($class_name) {
    // Check Controllers
    $controller_file = CONTROLLERS_PATH . '/' . $class_name . '.php';
    if (file_exists($controller_file)) {
        require_once $controller_file;
        return;
    }

    // Check Entities
    $entity_file = MODELS_PATH . '/Entities/' . $class_name . '.php';
    if (file_exists($entity_file)) {
        require_once $entity_file;
        return;
    }

    // Check Managers
    $manager_file = MODELS_PATH . '/Managers/' . $class_name . '.php';
    if (file_exists($manager_file)) {
        require_once $manager_file;
        return;
    }

    // Check Config
    $config_file = BASE_PATH . '/Config/' . $class_name . '.php';
    if (file_exists($config_file)) {
        require_once $config_file;
        return;
    }
});

// Basic Routing
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

// Remove script name from URI to get the relative path
$base_dir = dirname($script_name);
$path = str_replace($base_dir, '', $request_uri);
$path = trim(parse_url($path, PHP_URL_PATH), '/');

// Default Route
if ($path === '' || $path === 'index.php') {
    $controllerName = 'HomeController';
    $action = 'index';
} else {
    $parts = explode('/', $path);
    $controllerName = ucfirst($parts[0]) . 'Controller';
    $action = isset($parts[1]) ? $parts[1] : 'index';
}

// Dispatch to Controller
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        // Optionally pass parameters
        $controller->$action();
    } else {
        http_response_code(404);
        echo "404 - Action Not Found";
    }
} else {
    http_response_code(404);
    echo "404 - Controller Not Found";
}
