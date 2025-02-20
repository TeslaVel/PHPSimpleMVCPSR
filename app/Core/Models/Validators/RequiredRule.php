<?php

namespace App\Core\Models\Validators;

class RequiredRule {
  public static function validate($value) {
    return !empty($value);
  }
}