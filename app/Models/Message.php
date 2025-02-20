<?php

namespace App\Models;

use App\Core\Models\BaseModel;
use App\Models\Post;
use App\Models\User;

class Message extends BaseModel {

  public static $name = 'messages';
  public static $validations = [
    'message' => 'required|string|min:4',
    'user_id' => 'required',
    'post_id' => 'required',
  ];

  public static $fillableFields = [
    'message', 'created_at', 'updated_at', 'user_id', 'post_id'
  ];

  public function post() {
    return $this->belongsTo(Post::class, 'post_id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
}