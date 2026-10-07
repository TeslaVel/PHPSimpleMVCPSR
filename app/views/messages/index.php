<?php

$fields = [
    ['name' => 'id',],
    ['name' => 'message', 'linked' => true],
    ['name' => 'email', 'callable' => 'user', 'label' => 'User'],
    ['name' => 'id', 'callable' => 'post', 'label' => 'Post Id' ],
    // ['name' => 'count', 'callable' => 'user->messages', 'label' => 'User Messages' ],
];

$table = Component::render('TableComponent',
  [$messages, 'messages', $fields, [], 'Message Lists']
);

?>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1">
                        <i class="bi bi-chat-dots text-success me-2"></i>
                        Gestión de Mensajes
                    </h1>
                    <p class="text-muted mb-0">Administra y gestiona todos los mensajes del sistema</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Total Mensajes</h6>
                            <h3 class="mb-0"><?php echo count($messages); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-chat-dots display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Usuarios Únicos</h6>
                            <h3 class="mb-0"><?php echo count(array_unique(array_column($messages, 'email'))); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-people display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Posts Relacionados</h6>
                            <h3 class="mb-0"><?php echo count(array_unique(array_column($messages, 'id'))); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-file-text display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-table me-2"></i>
                        Lista de Mensajes
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php echo $table; ?>
                </div>
            </div>
        </div>
    </div>
</div>
