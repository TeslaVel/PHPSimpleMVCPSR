<?php

namespace App\Core\Controllers;

// require_once 'core/models/BaseModel.php';
// use App\Core\Models

use App\Core\Helpers\Auth;
use App\Core\Helpers\Cookie;
use App\Core\Helpers\Flashify;
use App\Core\Helpers\Redirect;
use App\Core\Helpers\Render;
use App\Core\Loggers\Logger;
use App\Core\Controllers\ResourceControllerInterface; // <-- ¡Este es el importante!

abstract class BaseController implements ResourceControllerInterface {
  use \App\Core\Helpers\Request;

  public $logger;

  public function __construct() {
    $this->logger = Logger::getInstance();
  }
}