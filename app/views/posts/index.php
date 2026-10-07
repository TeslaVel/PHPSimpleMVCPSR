<?php

$fields = [
    ['name' => 'id',],
    ['name' => 'title', 'linked' => true],
    ['name' => 'email', 'callable' => 'user' ],
    ['name' => 'body'],
    ['name' => 'count', 'callable' => 'messages', 'label' => 'messages'],
];

$table = Component::render('TableComponent', [
  $posts->all(), 'posts', $fields, [], 'Post Lists', []
]);

?>


<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1">
                        <i class="bi bi-file-text text-primary me-2"></i>
                        Gestión de Posts
                    </h1>
                    <p class="text-muted mb-0">Administra y gestiona todas las publicaciones del sistema</p>
                </div>
                <div class="mt-2 mt-md-0">
                    <a class="btn btn-success btn-lg" href="/<?php echo $url_helper::getAppPath(); ?>/posts/new">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nuevo Post
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Total Posts</h6>
                            <h3 class="mb-0"><?php echo count($posts->all()); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-file-text display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Mensajes</h6>
                            <h3 class="mb-0"><?php echo array_sum(array_column($posts->all(), 'count')); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-chat-dots display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Usuarios Activos</h6>
                            <h3 class="mb-0"><?php echo count(array_unique(array_column($posts->all(), 'email'))); ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-people display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Promedio</h6>
                            <h3 class="mb-0"><?php echo count($posts->all()) > 0 ? round(array_sum(array_column($posts->all(), 'count')) / count($posts->all()), 1) : 0; ?></h3>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-graph-up display-4 opacity-50"></i>
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
                        Lista de Posts
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php echo $table; ?>
                </div>
            </div>
        </div>
    </div>
</div>
