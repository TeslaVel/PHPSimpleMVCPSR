<?php

namespace App\Core\Helpers;

class Flashify {
  public static function create($params) {
    session_start();

    $_SESSION['flash'] = [
      'message' => $params['message'],
      'type' => $params['type'],
      'alert_type' => 'banner',
    ];
  }

  public static function getFlash() {
    session_start();

    if (isset($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      unset($_SESSION['flash']);
      return $flash;
    }

    return null;
  }
}
