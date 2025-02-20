<?php

namespace App\Core\Helpers;

class Cookie {
  public static function store($name, $params = []) {
    $expirationDate = time() + 3600 * 1; // 1 hora

    $jsonData = json_encode($params);
    $encodedData = base64_encode($jsonData);
    setcookie($name, $encodedData, $expirationDate, '/');
  }

  public static function getCookie($name) {
    // Check if cookie exists
    if (!isset($_COOKIE[$name])) {
      return null;
    }

    // Decode and return data
    try {
      $encodedData = $_COOKIE[$name];
      $jsonData = base64_decode($encodedData);
      return json_decode($jsonData, true); // Decode as associative array
    } catch (Exception $e) {
      // Handle potential errors during decoding
      return null;
    }
  }

  public static function check($name) {
    return isset($_COOKIE[$name]);
  }
  public static function delete($name) {
    setcookie($name, '', time() - 3600, '/');
    unset($_COOKIE[$name]);
  }
}