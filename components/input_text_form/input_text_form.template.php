<?php 
    $label = $_SESSION['parametrosComponente'][0];
    $identificador  = $_SESSION['parametrosComponente'][1];
?>

<div class="mb-3">
  <label for="<?= $identificador ?>" class="form-label"><?= $label ?></label>
  <input type="text" class="form-control" id="<?= $identificador ?>" name="<?= $identificador ?>">
</div>