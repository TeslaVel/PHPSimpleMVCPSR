<?php

namespace App\Core\Helpers;

trait Request {
  public $request;

  public function requestInit() {
    $this->request = (object) array_merge($_GET, $_POST);
  }

  public function __get($key) {
    if (isset($this->request->$key)) {
      return $this->request->$key;
    } else {
      return null;
    }
  }
}