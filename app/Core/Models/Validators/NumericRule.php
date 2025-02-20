<?php

namespace App\Core\Models\Validators;

class NumericRule {
  public static function validate($value) {
    return is_numeric($value);
  }
}