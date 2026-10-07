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

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-pencil-square display-1 text-success"></i>
                </div>
                <h1 class="h2 fw-bold text-success">Editar Mensaje</h1>
                <p class="text-muted">Modifica el contenido de tu mensaje</p>
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
                    Los cambios se aplicarán inmediatamente al guardar
                </small>
            </div>
        </div>
    </div>
</div>
