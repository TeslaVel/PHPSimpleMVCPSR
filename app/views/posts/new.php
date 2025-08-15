<?php

$fields = [
    [
        'type' => 'text', 'name' => 'post[title]', 'label' => 'Title',
        'required' => true, 'is_row' => true,
    ],
    [
      'type' => 'textarea', 'name' => 'post[body]', 'label' => 'Body',
      'required' => true, 'is_row' => false
    ]
];

$action_buttons = [
  'submit' => [
    'label' => 'Create',
  ],
  'back' => [
    'label' => 'Back',
    'url' => '/'.$url_helper::getAppPath().'/posts'
  ]
];

$form = Component::render('FormComponent', [[
            'path' => 'posts', 'title' => 'Create Post',
            'record' => null, 'fields' => $fields,
            'action_buttons' => $action_buttons
            ]]);

?>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-3">
  <?php echo $form; ?>
</div>
