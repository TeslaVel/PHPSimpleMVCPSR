<?php

if ( empty($post)) {
    echo "Post not found";
    return;
}


$fields = [
    [
        'type' => 'text', 'name' => 'post[title]', 'label' => 'Title',
        'required' => true, 'styles' => 'color: red;',
        'value' => $post->title,
        'is_row' => true,
    ],
    [
      'type' => 'textarea', 'name' => 'post[body]', 'label' => 'Body',
      'required' => true,
      'value' => $post->body,
      'is_row' => false
    ]
];

$action_buttons = [
  'submit' => ['label' => 'Update'],
  'back' => ['label' => 'Back', 'url' => '/'.$url_helper::getAppPath().'/posts']
];

$form = Component::render('FormComponent', [[
            'path' => 'posts', 'is_new' => false, 'title' => 'Update Post',
            'record' => $post, 'fields' => $fields,
            'action_buttons' => $action_buttons
            ]]);

?>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>
