<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/<?php echo $url_helper::getAppPath(); ?>">PHPSimpleMVC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php
        if ($auth_helper::check()) {
      ?>
        <li class="nav-item <?php echo $url_helper::getCurrentPath() == 'posts' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo $url_helper::getAppPath(); ?>/posts">Posts</a>
        </li>
        <li class="nav-item <?php echo $url_helper::getCurrentPath() == 'messages' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo $url_helper::getAppPath(); ?>/messages">Messages <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php echo $url_helper::getCurrentPath() == 'users' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo $url_helper::getAppPath(); ?>/users">Users</a>
        </li>
      <?php } ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
  </div>
  <span>
    <?php
      if ($auth_helper::check()) {
    ?>
      <span class="text-white d-flex align-items-center mx-1">
       <span class="p-0">( <?php echo $auth_helper::user()->first_name; ?> )</span>
       <a class="nav-link text-white p-1" href="/<?php echo $url_helper::getAppPath(); ?>/session/delete">Sign Out</a>
      </span>
    <?php
      } else {
    ?>
      <a class="nav-link text-white" href="/<?php echo $url_helper::getAppPath(); ?>/session/signin">Sing In</a>
    <?php
      }
    ?>
  </span>
</nav>