<?php

if ( empty($post)) {
    echo "Post not found";
    return;
}


$fields = [
    [
        'type' => 'text', 'name' => 'post[title]', 'label' => 'Title',
        'required' => true, 'styles' => 'color: red;',
        'value' => $post->title,
        'is_row' => true,
    ],
    [
      'type' => 'textarea', 'name' => 'post[body]', 'label' => 'Body',
      'required' => true,
      'value' => $post->body,
      'is_row' => false
    ]
];

$action_buttons = [
  'submit' => ['label' => 'Update'],
  'back' => ['label' => 'Back', 'url' => '/'.$url_helper::getAppPath().'/posts']
];

$form = Component::render('FormComponent', [[
            'path' => 'posts', 'title' => 'Update Post',
            'record' => $post, 'fields' => $fields,
            'action_buttons' => $action_buttons
            ]]);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-pencil-square display-1 text-warning"></i>
                </div>
                <h1 class="h2 fw-bold text-warning">Editar Post</h1>
                <p class="text-muted">Modifica el contenido de tu publicación</p>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <?php echo $form; ?>
                </div>
            </div>

            <!-- Help Text -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Los cambios se guardarán automáticamente al enviar el formulario
                </small>
            </div>
        </div>
    </div>
</div>
