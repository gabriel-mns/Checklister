<?php 
    $label = $_SESSION['parametrosComponente'][0];
    $identificador  = $_SESSION['parametrosComponente'][1];
    $value = $_SESSION['parametrosComponente'][2] ?? '';
?>

<div class="mb-3">
  <label for="<?= $identificador ?>" class="form-label input_text_form-label"><?= $label ?></label>
  <input type="text" class="form-control" id="<?= $identificador ?>" name="<?= $identificador ?>" value="<?=$value?>">
</div>