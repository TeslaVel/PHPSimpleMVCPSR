<?php

$fields = [
  [ 'type' => 'email', 'name' => 'session[email]', 'label' => 'Email',
    'placeholder' => 'Email',
    'required' => true, 'is_row' => false,
  ],
  [ 'type' => 'password', 'name' => 'session[password]', 'label' => 'Password',
    'placeholder' => 'Password',
    'required' => true, 'is_row' => false,
  ],
];

$action_buttons = [
  'submit' => [  'label' => 'Log In'],
  'back' => ['hidden' => true],
  'generic' => [
    'label' => 'Sign up',
    'with_icon' => false,
    'hidden' => false,
    'color' => 'success',
    'url' => '/'.$url_helper::getAppPath().'/session/signup'
  ]
];

$options = [
  'path' => 'session', 'is_new' => true, 'title' => 'Sign In',
  'fields' => $fields, 'action_buttons' => $action_buttons
];

$form = Component::render('FormComponent', [$options]);
?>

<div class="container-fluid">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <!-- Login Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-lock display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Iniciar Sesión</h2>
                        <p class="text-muted">Accede a tu cuenta para continuar</p>
                    </div>

                    <!-- Form -->
                    <div class="mt-4">
                        <?php echo $form; ?>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            ¿No tienes cuenta? 
                            <a href="/<?php echo $url_helper::getAppPath(); ?>/session/signup" class="text-primary text-decoration-none fw-semibold">
                                Regístrate aquí
                            </a>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>
                    Tus datos están protegidos con encriptación SSL
                </small>
            </div>
        </div>
    </div>
</div>
