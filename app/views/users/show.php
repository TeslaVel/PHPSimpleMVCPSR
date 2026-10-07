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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 col-xl-6">
            <!-- User Profile Header -->
            <div class="text-center mb-4">
                <div class="mb-3">
                    <i class="bi bi-person-circle display-1 text-warning"></i>
                </div>
                <h1 class="h2 fw-bold text-warning">Perfil de Usuario</h1>
                <p class="text-muted">Información detallada del usuario</p>
            </div>

            <!-- User Details Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-person me-2"></i>
                            Información Personal
                        </h4>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-person-check me-1"></i>
                            Usuario Activo
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
                    Esta información es visible solo para usuarios autenticados
                </small>
            </div>
        </div>
    </div>
</div>

