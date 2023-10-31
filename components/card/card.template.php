<?php 
    $rotaPaginaCadastroTemplate = "../pagina_cadastro_template/pagina_cadastro_template.php";
    
    $tipoCard = $_SESSION['parametrosComponente'][0]; #novoTemplate, templateJaCadastrado, avaliacao

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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="m499-287 335-335-52-52-335 335 52 52Zm-261 87q-100-5-149-42T40-349q0-65 53.5-105.5T242-503q39-3 58.5-12.5T320-542q0-26-29.5-39T193-600l7-80q103 8 151.5 41.5T400-542q0 53-38.5 83T248-423q-64 5-96 23.5T120-349q0 35 28 50.5t94 18.5l-4 80Zm280 7L353-358l382-382q20-20 47.5-20t47.5 20l70 70q20 20 20 47.5T900-575L518-193Zm-159 33q-17 4-30-9t-9-30l33-159 165 165-159 33Z"/>
                        </svg>    
                        Avaliar
                    </button>
                </div>
            </div>
        END;
    }
    if ($tipoCard == "avaliacao") {
        echo <<<END
            <div class="card-container card-container-template-cadastrado">
                <div class="card-container-texto">
                    <h2 class="card-titulo">$tituloCardCadastrado</h2>

                    <p class="card-subtitulo">Avaliado em: $dataCriacaoCardCadastrado</p>
                    <p class="card-subtitulo">Versão do template: $versaoCardCadastrado</p>
                    <p class="card-subtitulo card-ultimo-subtitulo">Avaliador: $autorCardCadastrado</p>
                </div>
                <div class="card-container-botao">
                    <button type="button" class="btn btn-success" id="card-btn-avaliar" name="card-btn-avaliar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="24" viewBox="0 -960 960 960" width="24">
                            <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                        </svg>    
                        Visualizar
                    </button>
                </div>
            </div>
        END;
    }
?>