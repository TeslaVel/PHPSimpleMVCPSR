<?php

namespace App\Controllers;

use App\Core\Controllers\BaseController;
use App\Core\Helpers\Render;
use App\Core\Helpers\Redirect;
use App\Core\Helpers\Flashify;
use App\Core\Helpers\Auth;
use App\Core\Helpers\URL;
use App\Core\Loggers\ActionLogger;

use App\Models\User;

class SessionController extends BaseController {
  private $userModel;
  public $indexUrl;
  private $logger;

  public function __construct() {
    parent::__construct();
    $this->logger = ActionLogger::getInstance();
    $this->userModel = new User();
    $this->indexUrl = '/'.URL::getAppPath().'/';
  }

  public function signin() {

    if (Auth::check() ) {
      Flashify::create([
        'type' => 'info',
        'message' => 'User is already logged',
      ]);
      Redirect::to($this->indexUrl);
      exit;
    }

    Render::view('session/signin', []);
  }

  public function create() {
    if (!isset($this->request->session)) return Redirect::to($this->indexUrl);

    $data = $this->request->session;

    $user = $this->userModel->findBy('email', $data['email'])->first();
    $exception = null;

    if (!$user) {
      $exception = "User not found";
    }

    if (!password_verify($data['password'], $user->password)) {
      $exception = "Invalid Password";
    }

    if ($exception != null) {
      Flashify::create([
        'type' => 'danger',
        'message' => $exception,
      ]);

      return Redirect::to($this->indexUrl);
    }
   
    Auth::store($user);
    Redirect::to($this->indexUrl);
  }

  public function signup() {
    Render::view('session/signup', []);
  }
  public function register() {
    if (!isset($this->request->session)) return Redirect::to($this->indexUrl);

    $data = $this->request->session;

    $exception = null;

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $exception = "Correo electrónico no válido";
    }

    if (strlen($data['password']) < 7) {
      $exception = "La contraseña debe tener al menos 8 caracteres";
    }

    if ($exception != null) {
      Flashify::create([
        'type' => 'danger',
        'message' => $exception,
      ]);

      return  Redirect::to($this->indexUrl);
    }

    $encrypted = password_hash($data['password'], PASSWORD_BCRYPT);

    $newData = [
      ...$_POST['session'],
      'password' => $encrypted
    ];

    $id = $this->userModel->save($newData);

    if ($id > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'User was created',
      ]);
    } else {
      Flashify::create([
        'type' => 'danger',
        'message' => 'User cannot be created',
      ]);
    }

    Redirect::to($this->indexUrl);
  }

  public function delete() {
    Auth::delete();
    Redirect::to($this->indexUrl);
  }
}

