<?php

namespace App\Models;

use App\Core\Models\BaseModel;
use App\Models\Message;
use App\Models\Post;

class User extends BaseModel {

  public static $name = 'users';

  public static $updateValidations = [
    'first_name' => 'required|string|min:4',
    'last_name' => 'required|string|min:4',
    'email' => 'required|string|email',
  ];

  public static $loginValidations = [
    'email' => 'required|email',
    'password' => 'required|string',
  ];

  public static $registerValidations = [
    'first_name' => 'required|string|min:4',
    'last_name' => 'required|string|min:4',
    'email' => 'required|email',
    'password' => 'required|string|min:8',
  ];

  public static $fillableFields = [
    'first_name', 'last_name', 'created_at', 'updated_at', 'email', 'password'
  ];

  public function posts() {
    return $this->hasMany(Post::class, 'user_id', 'id');
  }

  public function messages() {
    return $this->hasMany(Message::class, 'user_id', 'id');
  }
}
