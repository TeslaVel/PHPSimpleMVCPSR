<?php

namespace App\Controllers;

use App\Core\Controllers\BaseController;
use App\Core\Loggers\ActionLogger;
use App\Core\Helpers\Render;

class HomeController extends BaseController {
  private $logger;

  public function __construct() {
    $this->logger = ActionLogger::getInstance();
  }

  public function index() {
    $this->logger->log('Enter to home page');
    Render::view('home/index', []);
  }
}

