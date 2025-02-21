<?php

namespace App\Controllers;

use App\Core\Controllers\BaseController;
use App\Core\Helpers\Render;

class HomeController extends BaseController {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $this->logger->log('Enter to home page');
    Render::view('home/index', []);
  }
}

