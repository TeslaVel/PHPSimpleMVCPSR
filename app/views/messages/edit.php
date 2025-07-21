<?php

if ( empty($message)) {
    echo "Message not found";
    return;
}

$fields = [
  [
      'type' => 'textarea', 'name' => 'message[message]', 'label' => 'Message',
      'required' => true,
      'value' => $message->message,
      'is_row' => false,
  ]
];

$action_buttons = [
'submit' => ['label' => 'Update'],
'back' => ['label' => 'Back', 'url' => '/'.$url_helper::getAppPath().'/messages']
];

$form = Component::render('FormComponent', [[
          'path' => 'messages', 'is_new' => false, 'title' => 'Update Message',
          'record' => $message, 'fields' => $fields,
          'action_buttons' => $action_buttons
        ]]);

?>

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto pt-5">
  <?php echo $form; ?>
</div>
