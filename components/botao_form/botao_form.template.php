<?php 
    $label = $_SESSION['parametrosComponente'][0];
    $tipoCor  = $_SESSION['parametrosComponente'][1]; #primary, secondary, success, danger, warning, info, light, gray, dark, link
    $isDisabled = $_SESSION['parametrosComponente'][2] ? 'disabled': ''; #true ou false
    $identificador = $_SESSION['parametrosComponente'][3];
?>

<button 
    type="button" 
    class="btn btn-<?= $tipoCor ?>" 
    id="<?= $identificador ?>" 
    name="<?= $identificador ?>"
    <?= $isDisabled ?>
>
    <?= $label ?>
</button>