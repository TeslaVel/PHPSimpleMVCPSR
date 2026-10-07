<?php

$fields_show = [
    ['name' => 'id',],
    ['name' => 'title'],
    ['name' => 'email', 'callable' => 'user' ],
    ['name' => 'body'],
    ['name' => 'count', 'callable' => 'messages', 'label' => 'Messages']
];

$table_args = [
  'path' => 'posts', 'record' => $post,
  'fields' => $fields_show,
  'table_classes' => ['classes' => "table-borderless"],
  'card_classes' => [
    'classes' => '',
    'card_footer' => ['classes' => 'd-flex justify-content-end']
  ]
];

$table =  Component::render('TableShowComponent', [$table_args]);

$fields_comment = [
    ['type' => 'hidden', 'name' => 'message[post_id]', 'value' => $post->id],
    [
      'type' => 'text', 'name' => 'message[message]', 'label' => 'Message',
      'required' => true,
      'is_row' => true,
    ]
];

$action_buttons_comment = [
  // 'submit' => ['label' => 'Update'],
  'back' => ['label' => 'Back', 'url' => '/'.$url_helper::getAppPath().'/posts']
];

$form_args = [
  'path' => 'messages', 'is_new' => true, 'title' => 'Create Comment',
  'fields' => $fields_comment,
  'action_buttons' => $action_buttons_comment
];

$form_comment = Component::render('FormComponent', [$form_args]);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Post Details -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-file-text me-2"></i>
                            Detalles del Post
                        </h4>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-chat-dots me-1"></i>
                            <?php echo $post->count ?? 0; ?> comentarios
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php echo $table; ?>
                </div>
            </div>

            <!-- Comment Form -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-chat-plus me-2"></i>
                        Agregar Comentario
                    </h5>
                </div>
                <div class="card-body">
                    <?php echo $form_comment; ?>
                </div>
            </div>

            <!-- Comments Section -->
            <?php if (count($messages) > 0) { ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-chat-dots me-2"></i>
                            Comentarios (<?php echo count($messages); ?>)
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="comments-container" style="max-height: 400px; overflow-y: auto;">
                            <?php foreach ($messages as $msg) { ?>
                                <div class="border-bottom p-3">
                                    <?php echo Component::render('CardComponent', [[
                                        'header_title' => '<i class="bi bi-person-circle me-2"></i>' . $msg->user()->email,
                                        'body_text' => $msg->message,
                                        'card_footer_classes' => 'px-3 py-2 d-flex justify-content-end align-items-center mt-2',
                                        'action_buttons' => [
                                            'delete' => [
                                                'path' => "messages/delete/$msg->id",
                                            ],
                                            'edit' => [
                                                'path' => "messages/edit/$msg->id",
                                                'with_icon' => true
                                            ]
                                        ]
                                    ]]); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-chat-dots display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">No hay comentarios aún</h5>
                        <p class="text-muted">Sé el primero en comentar este post</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
