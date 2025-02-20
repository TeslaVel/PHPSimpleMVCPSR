<?php

namespace App\Core\Config;

use App\Core\Helpers\Auth;
use App\Core\Helpers\URL;

class Router {
  private static $protected_paths = [];
  private static $routes = [];
  private static $currentFilter = [];
  private static $filters = [];

  public static function get($uri, $handler) {
    self::add('GET', $uri, $handler);
  }

  public static function post($uri, $handler) {
    self::add('POST', $uri, $handler);
  }

  public static function add($method, $uri, $handler) {
    if( self::$currentFilter != null) {
      $filter = self::$currentFilter;
      self::$routes[$method][$uri] = $filter($handler);
    } else {
      self::$routes[$method][$uri] = $handler;
    }
  }

  public static function routes() {
    return self::$routes;
  }

  public static function match($method, $uri) {
    foreach (self::$routes[$method] as $pattern => $handler) {

      // $pattern = preg_replace('/\{([^\}]*)\}/', '(?<$1>[^\/]+)', $pattern);
      $npattern = preg_replace('/\{(\w+)\}/', '(?<$1>\d+)', $pattern);
      if (preg_match("#^{$npattern}$#", $uri, $matches)) {

        $segments = explode('/', $pattern);

        $params = [];

        foreach ($segments as $i => $segment) {
          if (preg_match('/^\{(\w+)\}$/', $segment, $mtchs)) {
            $param_name = $mtchs[1];  // Extract parameter name
            $params[$param_name] = $matches[$param_name];  // Initialize parameter with null value
          }
        }

        return [$handler, $params];
      }
    }

    return null;
  }

  public static function dispatch($method) {
    $uri = URL::getCurrentRoute();
    // $request = new Request;
    $route = self::match($method, $uri);

    if ($route) {
      $handler = $route[0];
      $params = $route[1];
      self::callHandler($handler, $params);
    } else {
        echo "404 Not Found";
        exit;
    }
  }

  // public static function checkIfExistsController($controllerName) {
  //   return file_exists(URL::getRootPath()."/controllers/$controllerName.php");
  // }

  # Nota: ver como incluir el controlador si es que estamos usando
  # namespaces
  private static function callHandler($handler, $params) {
    if (is_callable($handler)) {
        call_user_func($handler, $params);
    } elseif (is_string($handler)) {
        list($controllerName, $method) = explode('@', $handler);

        $fullControllerName = "App\\Controllers\\$controllerName";

        if (!class_exists($fullControllerName)) {
            echo "<br>The Controller $controllerName: not found";
            exit;
        }

        $controller = new $fullControllerName();
        $controller->requestInit();
    
        if (isset($params) && count($params) > 0) {
            $controller->$method(...$params);
        } else {
            $controller->$method();
        }
    } else {
        echo "Invalid action";
    }
  }
  // private static function callHandler($handler, $params) {
  //   if (is_callable($handler)) {
  //     call_user_func($handler, $params);
  //   } elseif (is_string($handler)) {
  //     list($controllerName, $method) = explode('@', $handler);

  //     if (!self::checkIfExistsController($controllerName)) {
  //       echo "<br>The Controller $controllerName: not found";
  //       exit;
  //     }

  //     $controllerPath = "controllers/$controllerName.php";
  //     include_once $controllerPath;

  //     $logger = new ActionLogger();
  //     $controller = new $controllerName($logger);
  //     $controller->requestInit();
  //     if (isset($params) && count($params) > 0) {
  //       $controller->$method(...$params);
  //     } else {
  //       $controller->$method();
  //     }
  //   } else {
  //     echo "Invalid action";
  //   }
  // }

  public static function group($array, $callback) {
    if(isset($array)) self::$currentFilter = self::$filters[$array['before']];
    $callback();
    if(isset($array)) self::$currentFilter = null ;
  }

  public static function filter($name, $callback) {
    self::$filters[$name] = $callback;
  }
}
