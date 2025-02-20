<?php

namespace App\Core\Models\Validators;

class MaxRule {
  public static function validate($value, $max, $isString) {
    $val = $isString ? strlen($value) : $value;
    return $val <= $max;
  }
}