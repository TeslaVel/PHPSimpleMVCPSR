<?php
ob_start();
?>

<div class="col-8 mx-auto">
  <h2>Index</h2>
  <p>
    Welcome, this is a simple MVC project in PHP
  </p>
</div>

<?php
  $content = ob_get_clean();
?>
