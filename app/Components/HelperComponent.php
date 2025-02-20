<?php

namespace App\Components;

class HelperComponent {
  public static function method_or_field($row, $callable, $property) {
    $methodNames = explode("->", $callable);
    $result = $row;

    foreach ($methodNames as $methodName) {
      if (method_exists($result, $methodName)) {
          $result = $result->$methodName();
      }
    }

    if (method_exists($result, $property)) {
      return $result = $result->$property();
    }

    return $result = $result->$property;
  }
}