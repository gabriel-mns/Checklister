<?php 
    $rotaPaginaCadastroTemplate = "../pagina_cadastro_template/pagina_cadastro_template.php";
    
    $tipoCard = $_SESSION['parametrosComponente'][0]; #novoTemplate, templateJaCadastrado

    if ($tipoCard != 'novoTemplate') {
        $tituloCardCadastrado =         $_SESSION['parametrosComponente'][1];
        $dataCriacaoCardCadastrado =    $_SESSION['parametrosComponente'][2];
        $versaoCardCadastrado =         $_SESSION['parametrosComponente'][3];
        $autorCardCadastrado =          $_SESSION['parametrosComponente'][4];
    }


if ($tipoCard == 'novoTemplate') {
    echo <<<END
        <a href="$rotaPaginaCadastroTemplate" class="card-link-novo-card">
                <div class="card-container cor-fundo-verde-claro">
                    
                    <h2 class="card-titulo">Criar novo template</h2>

                    <svg class="card-iconePlus" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
        </a>
    END;
}
if ($tipoCard == 'templateJaCadastrado') {
    echo <<<END
        <div class="card-container card-container-template-cadastrado">
            <div class="card-container-texto">
                <h2 class="card-titulo">$tituloCardCadastrado</h2>

                <p class="card-subtitulo">Criado em: $dataCriacaoCardCadastrado</p>
                <p class="card-subtitulo">Versão: $versaoCardCadastrado</p>
                <p class="card-subtitulo card-ultimo-subtitulo">Autor: $autorCardCadastrado</p>
            </div>
            <div class="card-container-botao">
                <button type="button" class="btn btn-success" id="card-btn-avaliar" name="card-btn-avaliar">
                    Avaliar
                </button>
            </div>
        </div>
    END;
}
?>