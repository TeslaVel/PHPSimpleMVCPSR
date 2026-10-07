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

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- Message Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-chat-square-text display-1 text-success"></i>
                </div>
                <h1 class="h2 fw-bold text-success">Detalle del Mensaje</h1>
                <p class="text-muted">Información completa del mensaje</p>
            </div>

            <!-- Message Details Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-chat-dots me-2"></i>
                            Información del Mensaje
                        </h4>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-clock me-1"></i>
                            Mensaje
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php echo $table; ?>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Este mensaje está asociado a un post específico
                </small>
            </div>
        </div>
    </div>
</div>
