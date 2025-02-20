<?php

namespace App\Core\Helpers;

class Redirect {
  public static function to($baseUrl) {
    header("Location:  $baseUrl");
    exit;
  }
}