<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/<?php echo $url_helper::getAppPath(); ?>">
            <i class="bi bi-code-slash me-2"></i>
            <strong>PHP Simple MVC</strong>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if ($auth_helper::check()) { ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center <?php echo $url_helper::getCurrentPath() == 'posts' ? 'active' : ''; ?>" href="/<?php echo $url_helper::getAppPath(); ?>/posts">
                            <i class="bi bi-file-text me-1"></i>
                            Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center <?php echo $url_helper::getCurrentPath() == 'messages' ? 'active' : ''; ?>" href="/<?php echo $url_helper::getAppPath(); ?>/messages">
                            <i class="bi bi-chat-dots me-1"></i>
                            Messages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center <?php echo $url_helper::getCurrentPath() == 'users' ? 'active' : ''; ?>" href="/<?php echo $url_helper::getAppPath(); ?>/users">
                            <i class="bi bi-people me-1"></i>
                            Users
                        </a>
                    </li>
                <?php } ?>
            </ul>
            
            <ul class="navbar-nav">
                <?php if ($auth_helper::check()) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <?php echo $auth_helper::user()->first_name; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/<?php echo $url_helper::getAppPath(); ?>/session/delete">
                                <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                            </a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/<?php echo $url_helper::getAppPath(); ?>/session/signin">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Sign In
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>