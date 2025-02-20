<?php


// $card = CardComponent::render([
//   'header_title' => 'Message Detail',
//   'card_classes' => 'mt-5',
//   'card_header_classes' => 'text-center',
//   'body_text' => '
//     <ul class="list-unstyled">
//         <li><strong>Message: </strong>'.$message->message.'</li>
//         <li><strong>User: </strong>'.$message->user()->email.'</li>
//         <li><strong>Post :</strong>'.$message->post()->title.'</li>
//     </ul>
//   ',
//   'card_footer_classes' => 'px-3 py-2 d-flex justify-content-end align-items-center mt-2',
//   'action_buttons' => [
//     'edit' => [
//       'path' => "messages/edit/$message->id",
//       'with_icon' => true,
//       'type' => 'button',
//     ],
//     'back' => [
//       'path' => "messages",
//       'with_icon' => true,
//       'type' => 'button',
//     ]
//   ]
// ]);

$fields_show = [
  ['name' => 'id',],
  ['name' => 'message'],
  ['name' => 'email', 'callable' => 'user' ],
  ['name' => 'title', 'callable' => 'post' ],
];

$table = Component::render('TableShowComponent', [[
  'path' => 'messages', 'record' => $message,
  'fields' => $fields_show,
  'table_classes' => ['classes' => "table-borderless"],
  'card_classes' => [
    'classes' => '',
    'card_footer' => ['classes' => 'd-flex justify-content-end']
  ]
]]);

ob_start();
?>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mt-5 mx-auto">
  <?php echo $table; ?>
</div>
<?php
$content = ob_get_clean();
?>
