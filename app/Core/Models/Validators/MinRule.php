<?php

namespace App\Core\Models\Validators;

class MinRule {
  public static function validate($value, $min, $isString) {
    $val = $isString ? strlen($value) : $value;
    return $val >= $min;
  }
}