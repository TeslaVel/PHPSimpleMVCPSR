<?php
$fields_show = [
  ['name' => 'id',],
  ['name' => 'email'],
  ['name' => 'first_name'],
  ['name' => 'last_name'],
  ['name' => 'count', 'callable' => 'messages', 'label' => 'Messages'],
  ['name' => 'count', 'callable' => 'posts', 'label' => 'Posts'],
];

$table = Component::render('TableShowComponent', [[
        'path' => 'users', 'record' => $user,
        'fields' => $fields_show,
        'table_classes' => ['classes' => "table-borderless"],
        'card_classes' => [
          'classes' => '',
          'card_footer' => ['classes' => 'd-flex justify-content-end']
        ]
      ]]);

?>
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mt-5 mx-auto">
  <?php echo $table; ?>
</div>

