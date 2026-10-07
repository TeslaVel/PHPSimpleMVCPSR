<?php

$fields = [
  [ 'type' => 'text', 'name' => 'session[first_name]', 'label' => 'First Name',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'text', 'name' => 'session[last_name]', 'label' => 'Laste Name',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'email', 'name' => 'session[email]', 'label' => 'Email',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'password', 'name' => 'session[password]', 'label' => 'Password',
    'required' => true, 'is_row' => false,
  ],
];

$action_buttons = [
  'submit' => [  'label' => 'Register'],
  'back' => ['hidden' => true],
  'generic' => [
    'label' => 'Sign in',
    'with_icon' => false,
    'hidden' => false,
    'color' => 'success',
    'url' => '/'.$url_helper::getAppPath().'/session/signin'
  ]
];

$form = Component::render('FormComponent', [[
          'path' => 'session', 'is_new' => true, 'title' => 'Sign Up',
          'custom_path' => 'register', 'fields' => $fields,
          'action_buttons' => $action_buttons
        ]]);

?>
<div class="container-fluid">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <!-- Register Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-person-plus display-1 text-success"></i>
                        </div>
                        <h2 class="fw-bold text-success">Crear Cuenta</h2>
                        <p class="text-muted">Regístrate para acceder al sistema</p>
                    </div>

                    <!-- Form -->
                    <div class="mt-4">
                        <?php echo $form; ?>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            ¿Ya tienes cuenta? 
                            <a href="/<?php echo $url_helper::getAppPath(); ?>/session/signin" class="text-success text-decoration-none fw-semibold">
                                Inicia sesión aquí
                            </a>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>
                    Al registrarte, aceptas nuestros términos y condiciones
                </small>
            </div>
        </div>
    </div>
</div>
