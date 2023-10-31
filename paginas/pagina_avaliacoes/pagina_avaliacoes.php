<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações - Checklister</title>

    <!-- Imports obrigatórios para todas as páginas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php include('../../framework/checklister_framework.php'); ?>
    <link rel="stylesheet" href="./pagina_avaliacoes.css">
</head>

<body class="body">
<?php usarComponenteComParametros('barra_navegacao', ['vermelho']); ?>

<div class="container-conteudo">
    <h1 class="titulo">Avaliações</h1>

    <?php usarComponenteComParametros('grid_cards', ["avaliacao"]); ?>
    
</div>
</body>
</html>