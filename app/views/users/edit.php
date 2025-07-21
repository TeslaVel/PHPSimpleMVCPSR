<?php

$fields = [
  [
      'type' => 'text', 'name' => 'user[first_name]', 'label' => 'First Name',
      'required' => true, 'styles' => 'color: red;',
      'value' => $user->first_name,
      'is_row' => true,
  ],
  [
    'type' => 'textarea', 'name' => 'user[last_name]', 'label' => 'Last Name',
    'required' => true,
    'value' => $user->last_name,
    'is_row' => true
  ]
];

$action_buttons = [
'submit' => ['label' => 'Update'],
'back' => ['label' => 'Back', 'url' => '/'.$url_helper::getAppPath().'/users']
];

$form = Component::render('FormComponent', [[
          'path' => 'users', 'is_new' => false, 'title' => 'Update User',
          'record' => $user, 'fields' => $fields,
          'action_buttons' => $action_buttons
        ]]);

?>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>

<?php
?>
