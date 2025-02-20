<?php
// use App\Core\Helpers\Flashify;
$flash = $flashify_helper::getFlash();

if ($flash) { ?>
  <?php if ($flash['alert_type'] == 'banner') { ?>
    <div class="alert alert-<?php echo $flash['type'];?> alert-dismissible fade show" role="alert"
    style="position: absolute;right: 0;z-index: 10;margin-top: 30px;width: auto;margin-right: 20px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <?php echo $flash['message']; ?>
    </div>
  <?php } ?>
<?php } ?>

