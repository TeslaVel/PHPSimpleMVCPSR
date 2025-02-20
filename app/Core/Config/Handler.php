<?php
namespace App\Core\Config;

use App\Core\Router;

$method = $_SERVER['REQUEST_METHOD'];
$uri = URL::getCurrentRoute();

Router::dispatch($method, $uri);