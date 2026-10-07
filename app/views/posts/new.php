<?php

$fields = [
    [
        'type' => 'text', 'name' => 'post[title]', 'label' => 'Title',
        'required' => true, 'is_row' => true,
    ],
    [
      'type' => 'textarea', 'name' => 'post[body]', 'label' => 'Body',
      'required' => true, 'is_row' => false
    ]
];

$action_buttons = [
  'submit' => [
    'label' => 'Create',
  ],
  'back' => [
    'label' => 'Back',
    'url' => '/'.$url_helper::getAppPath().'/posts'
  ]
];

$form = Component::render('FormComponent', [[
            'path' => 'posts', 'title' => 'Create Post',
            'record' => null, 'fields' => $fields,
            'action_buttons' => $action_buttons
            ]]);

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-plus-circle display-1 text-primary"></i>
                </div>
                <h1 class="h2 fw-bold text-primary">Crear Nuevo Post</h1>
                <p class="text-muted">Comparte tus ideas y pensamientos con la comunidad</p>
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
                    <i class="bi bi-lightbulb me-1"></i>
                    Consejo: Sé claro y conciso en tu título para atraer más lectores
                </small>
            </div>
        </div>
    </div>
</div>
