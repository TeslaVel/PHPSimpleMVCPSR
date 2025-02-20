<?php

$fields = [
    ['name' => 'id',],
    ['name' => 'message', 'linked' => true],
    ['name' => 'email', 'callable' => 'user', 'label' => 'User'],
    ['name' => 'id', 'callable' => 'post', 'label' => 'Post Id' ],
    ['name' => 'count', 'callable' => 'user->messages', 'label' => 'User Messages' ],
];

$table = Component::render('TableComponent',
  [$messages, 'messages', $fields, [], 'Message Lists']
);

ob_start();
?>

<div>
  <h1 class="text-center">Messages</h1>
  <div class="col-12">
    <?php echo $table; ?>
  </div>
</div>

<?php
  $content = ob_get_clean();
?>
