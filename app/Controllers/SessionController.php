<?php

namespace App\Controllers;

use App\Core\Controllers\BaseController;
use App\Core\Helpers\Render;
use App\Core\Helpers\Redirect;
use App\Core\Helpers\Flashify;
use App\Core\Helpers\Auth;
use App\Core\Helpers\URL;
use App\Helpers\ValidatorHelper;

use App\Models\User;

class SessionController extends BaseController {
  private $userModel;
  public $indexUrl;

  public function __construct() {
    parent::__construct();
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

    $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    $errors = ValidatorHelper::validate($data, $rules);

    if (!empty($errors)) {
        Flashify::create([
            'type' => 'danger',
            'message' => implode(', ', array_map(function($e) { return $e[0]; }, $errors)),
        ]);
        return Redirect::to($this->indexUrl);
    }

    $user = $this->userModel->findBy('email', $data['email'])->first();

    Auth::store($user);
    Redirect::to($this->indexUrl);
  }

  public function signup() {
    Render::view('session/signup', []);
  }

  public function register() {
    if (!isset($this->request->session)) return Redirect::to($this->indexUrl);
    $data = $this->request->session;
    $user = $this->userModel->execValidations($data);

    if ($user->fails()) {
      Flashify::create([
        'type' => 'danger',
        'message' => implode(',', $user->getErrorMessages()) ,
      ]);

      return Redirect::to($this->indexUrl.'session/signup');
    }

    $encrypted = password_hash($data['password'], PASSWORD_BCRYPT);

    $newData = [
      ...$data,
      'password' => $encrypted
    ];

    $user =$this->userModel->save($newData);

    if ($user->fails()) {
      Flashify::create([
        'type' => 'danger',
        'message' => implode(',', $user->getErrorMessages()),
      ]);
      return Redirect::to($this->indexUrl.'session/signup');
    } else {
      Flashify::create([
        'type' => 'success',
        'message' => 'User was created',
      ]);
    }

    Redirect::to($this->indexUrl);
  }

  public function index() {}
  public function show($id) {}
  public function edit($id) {}
  public function update($id) {}

  public function delete($id = null) {
    Auth::delete();
    Redirect::to($this->indexUrl);
  }
}

