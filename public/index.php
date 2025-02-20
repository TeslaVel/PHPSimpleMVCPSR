<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluye el autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Incluye el archivo de rutas
require_once __DIR__ . '/../app/Config/Routes.php';
use App\Core\Config\Router;

if (class_exists('App\Core\Config\Router')) {
} else {
    echo "No se pudo cargar la clase Router.";
}

// Inicializa el router
Router::dispatch($_SERVER['REQUEST_METHOD']);