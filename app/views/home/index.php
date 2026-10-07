<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Hero Section -->
            <div class="text-center mb-5">
                <div class="mb-4">
                    <i class="bi bi-code-slash display-1 text-primary"></i>
                </div>
                <h1 class="display-4 fw-bold text-primary mb-3">PHP Simple MVC</h1>
                <p class="lead text-muted mb-4">
                    Sistema de gestión desarrollado con PHP puro siguiendo el patrón Modelo-Vista-Controlador
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <span class="badge bg-primary fs-6 px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>PHP Puro
                    </span>
                    <span class="badge bg-success fs-6 px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>MVC Pattern
                    </span>
                    <span class="badge bg-info fs-6 px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>Bootstrap 5
                    </span>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-file-text display-4 text-primary"></i>
                            </div>
                            <h5 class="card-title">Gestión de Posts</h5>
                            <p class="card-text text-muted">
                                Crea, edita y administra publicaciones de manera sencilla y eficiente.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-chat-dots display-4 text-success"></i>
                            </div>
                            <h5 class="card-title">Sistema de Mensajes</h5>
                            <p class="card-text text-muted">
                                Comunícate y gestiona mensajes entre usuarios del sistema.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-people display-4 text-warning"></i>
                            </div>
                            <h5 class="card-title">Gestión de Usuarios</h5>
                            <p class="card-text text-muted">
                                Administra usuarios, permisos y roles del sistema.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="card-title mb-3">¿Listo para comenzar?</h3>
                        <p class="card-text text-muted mb-4">
                            Explora las funcionalidades del sistema y descubre todas las características disponibles.
                        </p>
                        <?php if ($auth_helper::check()) { ?>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="/<?php echo $url_helper::getAppPath(); ?>/posts" class="btn btn-primary btn-lg">
                                    <i class="bi bi-file-text me-2"></i>Ver Posts
                                </a>
                                <a href="/<?php echo $url_helper::getAppPath(); ?>/messages" class="btn btn-success btn-lg">
                                    <i class="bi bi-chat-dots me-2"></i>Ver Mensajes
                                </a>
                                <a href="/<?php echo $url_helper::getAppPath(); ?>/users" class="btn btn-info btn-lg">
                                    <i class="bi bi-people me-2"></i>Ver Usuarios
                                </a>
                            </div>
                        <?php } else { ?>
                            <a href="/<?php echo $url_helper::getAppPath(); ?>/session/signin" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
