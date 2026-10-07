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

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-person-gear display-1 text-info"></i>
                </div>
                <h1 class="h2 fw-bold text-info">Editar Usuario</h1>
                <p class="text-muted">Modifica la información del usuario</p>
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
                    <i class="bi bi-shield-check me-1"></i>
                    Los cambios se aplicarán inmediatamente al guardar
                </small>
            </div>
        </div>
    </div>
</div>

<?php
?>
