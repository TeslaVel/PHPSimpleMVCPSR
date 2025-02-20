<?php

namespace App\Core\Helpers;

use App\Config\Config;

class URL {
  public static function getRootPath() {
    $root = dirname(__FILE__);

    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
      return str_replace('\core\config', "",  $root);
    } else {
      return str_replace('/core/config', "",  $root);
    }
  }

  public static function getAppPath() {
    return Config::$APPNAME;
  }

  public static function getCurrentPath() {
    $uri = $_SERVER['REQUEST_URI'];
    $url = explode('?', $uri)[0];
    $dataRoute = explode("/", str_replace(".php", "", $url));
    return end($dataRoute);
  }

  public static function getCurrentRoute() {
    $uri = $_SERVER['REQUEST_URI'];
    $url = explode('?', $uri)[0];
    return str_replace('/'.self::getAppPath(), "", $url);
  }
}



