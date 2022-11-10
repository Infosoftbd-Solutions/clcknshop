<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?= $message ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">

  </button>
</div>
