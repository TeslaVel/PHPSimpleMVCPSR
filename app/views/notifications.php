<?php
$flash = $flashify_helper::getFlash();

if ($flash) { ?>
  <?php if ($flash['alert_type'] == 'banner') { ?>
    <div class="alert alert-<?php echo $flash['type'];?> alert-dismissible fade show position-fixed" 
         role="alert" 
         style="top: 20px; right: 20px; z-index: 1050; min-width: 300px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
      <div class="d-flex align-items-center">
        <i class="bi bi-<?php echo $flash['type'] == 'success' ? 'check-circle-fill' : ($flash['type'] == 'danger' ? 'exclamation-triangle-fill' : 'info-circle-fill'); ?> me-2"></i>
        <div class="flex-grow-1">
          <?php echo $flash['message']; ?>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  <?php } ?>
<?php } ?>

