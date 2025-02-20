<?php

$fields = [
  [ 'type' => 'text', 'name' => 'session[first_name]', 'label' => 'First Name',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'text', 'name' => 'session[last_name]', 'label' => 'Laste Name',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'email', 'name' => 'session[email]', 'label' => 'Email',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'password', 'name' => 'session[password]', 'label' => 'Password',
    'required' => true, 'is_row' => false,
  ],
];

$action_buttons = [
  'submit' => [  'label' => 'Register'],
  'back' => ['hidden' => true],
  'generic' => [
    'label' => 'Sign in',
    'with_icon' => false,
    'hidden' => false,
    'color' => 'success',
    'url' => '/'.$url_helper::getAppPath().'/session/signin'
  ]
];

$form = Component::render('FormComponent', [[
          'path' => 'session', 'is_new' => true, 'title' => 'Sign Up',
          'custom_path' => 'register', 'fields' => $fields,
          'action_buttons' => $action_buttons
        ]]);

ob_start();
?>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>
<?php
$content = ob_get_clean();
?>
