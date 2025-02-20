<?php

namespace App\Models;

use App\Core\Models\BaseModel;

use App\Models\Message;
use App\Models\User;

class Post extends BaseModel {
  public static $name = 'posts';

  public static $validations = [
    'title' => 'required|string|min:4',
    'body' => 'required|string|min:4',
  ];

  public static $fillableFields = [
    'title', 'body', 'created_at', 'updated_at', 'user_id'
  ];

  public function messages() {
    return $this->hasMany(Message::class, 'post_id' , 'id');
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
}