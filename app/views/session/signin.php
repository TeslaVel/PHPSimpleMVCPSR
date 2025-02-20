<?php

$fields = [
  [ 'type' => 'email', 'name' => 'session[email]', 'label' => 'Email',
    'placeholder' => 'Email',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'password', 'name' => 'session[password]', 'label' => 'Password',
    'placeholder' => 'Password',
    'required' => true, 'is_row' => false,
  ],
];

$action_buttons = [
  'submit' => [  'label' => 'Log In'],
  'back' => ['hidden' => true],
  'generic' => [
    'label' => 'Sign up',
    'with_icon' => false,
    'hidden' => false,
    'color' => 'success',
    'url' => '/'.$url_helper::getAppPath().'/session/signup'
  ]
];

$options = [
  'path' => 'session', 'is_new' => true, 'title' => 'Sign In',
  'fields' => $fields, 'action_buttons' => $action_buttons
];

$form = Component::render('FormComponent', [$options]);

ob_start();
?>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>

<?php
$content = ob_get_clean();
?>
