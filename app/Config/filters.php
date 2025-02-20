<?php

namespace App\Config;

use App\Core\Helpers\Flashify;
use App\Core\Helpers\Redirect;
use App\Core\Helpers\Auth;
use App\Core\Config\Router;
use App\Core\Helpers\URL;

Router::filter('Auth',function($action){
  if (!Auth::user()) {
    return function() {
      Flashify::create([
        'type' => 'danger',
        'message' => 'You are not logged to acces to this route',
      ]);
      Redirect::to('/'.URL::getAppPath().'/session/signin');
      exit;
    };
  }

  return $action;
});

Router::filter('Test',function($action){
  return function() {
    echo 'Print Somethimg';
    // Render::view('session/signin', []);
  };
});