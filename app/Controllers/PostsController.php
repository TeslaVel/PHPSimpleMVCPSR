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
use App\Models\Post;

class PostsController extends BaseController {
  public $indexUrl;
  private $postModel;
  private $logger;

  public function __construct() {
    parent::__construct();
    $this->logger = ActionLogger::getInstance();
    $this->postModel = new Post();
    $this->indexUrl = '/'.URL::getAppPath().'/posts';
  }

  public function index() {
    $this->logger->info('Accessing the posts index page');
    $posts = $this->postModel->findAll();
    Render::view('posts/index', compact('posts'));
  }

  public function show($id) {
    $post = $this->postModel->find($id);
    $messages = $post->messages()->all();;

    if ( empty($post)) return Redirect::to($this->indexUrl);

    Render::view('posts/show', compact('post', 'messages'));
  }

  public function new() {
    $userModel = new User();
    $users = $userModel->findAll()->all();

    Render::view('posts/new', compact('users'));
  }

  public function create() {
    if (!isset($this->request->post)) return Redirect::to($this->indexUrl);

    $id = $this->postModel->save([
      ...$this->request->post,
      'user_id' => Auth::user()->id
    ]);

    if ($id > 0) {
      Flashify::create([
        'type' => 'success',
        'message' => 'Post was create',
      ]);
    }

    Redirect::to($this->indexUrl);
  }

  public function edit($id) {
    $post = $this->postModel->find($id);

    if ( empty($post)) return Redirect::to($this->indexUrl);

    Render::view('posts/edit', compact('post'));
  }

  public function update($id) {
    if (!isset($this->request->post)) return Redirect::to($this->indexUrl);

    $post = $this->postModel->find($id);

    if (!isset($post)) return Redirect::to($this->indexUrl);

    $user_id = Auth::user()->id;

    $newData = [
      ...$this->request->post,
      'user_id' => $user_id
    ];

    $post->update($newData);

    if ($post->fails()) {
      Flashify::create([
        'type' => 'danger',
        'message' => implode(',', $post->getErrorMessages()) ,
      ]);
    } else {
      Flashify::create([
        'type' => 'success',
        'message' => 'Post was updated',
      ]);
    }

    return Redirect::to("$this->indexUrl/$id");
  }

  public function delete($id) {
    $affected = $this->postModel->find($id)->delete();

    if ($affected > 0) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'Post was deleted',
      ]);
    }

    return Redirect::to($this->indexUrl);
  }
}
