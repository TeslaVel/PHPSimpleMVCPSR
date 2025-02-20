<?php


namespace App\Core\Helpers;

use App\Config\Config;
use App\Models\User;
use App\Core\Helpers\Cookie;

class Auth {
  public static $user;

  public static function user() {
    if (self::$user) { return self::$user; }

    if (Cookie::getCookie(Config::$COOKIE_NAME) == NULL) {
      return null;
    }
  
    $user_id = Cookie::getCookie(Config::$COOKIE_NAME)['user_id'];
    self::$user = (new User)->find($user_id);
    return self::$user;
  }

  public static function check() {
    return self::user() !== null;
  }

  public static function store(User $user) {
    self::$user = $user;
    Cookie::store(Config::$COOKIE_NAME, ['user_id' => $user->id]);
  }

  public static function delete($params = []) {
    Cookie::delete(Config::$COOKIE_NAME);
    self::$user = null;
  }
}
