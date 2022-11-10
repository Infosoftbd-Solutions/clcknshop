<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>


<div class="alert alert-primary alert-dismissible fade show" role="alert">
<?= $message ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">

  </button>
</div>
