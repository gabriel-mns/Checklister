<?php 
  $rotaAtual = $_SERVER['REQUEST_URI'];
  $classeLinkPaginaTemplatesAtivo = '';
  $classeLinkPaginaAvaliacoesAtivo = '';

  if (strpos($rotaAtual, 'index.php')) {
    $classeLinkPaginaTemplatesAtivo = 'active';
  }
  if (strpos($rotaAtual, 'pagina_avaliacoes.php')) {
    $classeLinkPaginaAvaliacoesAtivo = 'active';
  } 
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../../paginas/pagina_principal/index.php">Checklister</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?=$classeLinkPaginaTemplatesAtivo?>" aria-current="page" href="../../paginas/pagina_principal/index.php">Templates</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$classeLinkPaginaAvaliacoesAtivo?>" aria-current="page" href="../../paginas/pagina_avaliacoes/pagina_avaliacoes.php">Avaliações</a>
        </li>
    </div>
  </div>
</nav>