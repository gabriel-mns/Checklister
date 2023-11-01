<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Checklister</title>

    <!-- Imports obrigatórios para todas as páginas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php include('../../framework/checklister_framework.php'); ?>
    <link rel="stylesheet" href="./pagina_visualizacao_avaliacao.css">
    <script src="./pagina_avaliacao_template.js"></script>
</head>

<?php

    $idChecklist = $_GET["idChecklist"];
    $idAvaliacao = $_GET["idAvaliacao"];

    $resultTemplate                 = buscarDadosDaChecklist($idChecklist);
    $resultChecklistItems           = buscarCheckListItemsDaChecklist($idChecklist);

    $rowTemplate = mysqli_fetch_assoc($resultTemplate);

    $tituloTemplate             = $rowTemplate["titulo"];
    $data_hora_criacao_template = $rowTemplate["data_hora_criacao"];
    $versao_template            = $rowTemplate["versao_checklist"];
    $autor                      = $rowTemplate["autor_versao"];
    
    $matrizChecklistItems = [];
    $contador = 0;

    while($rowChecklistItems = mysqli_fetch_assoc($resultChecklistItems)) {

        $arrayChecklistItem = [];

        array_push($arrayChecklistItem, $rowChecklistItems['descricao']);
        array_push($arrayChecklistItem, $rowChecklistItems['nome_responsavel_correcao']);
        array_push($arrayChecklistItem, $rowChecklistItems['gravidade_nao_conformidade']);
        array_push($arrayChecklistItem, $rowChecklistItems['prazo_em_dias']);
        array_push($arrayChecklistItem, $rowChecklistItems['id_checklist_item']);

        array_push($matrizChecklistItems, $arrayChecklistItem);
    }

    $resultCabecalhoAvaliacao = buscarCabecalhoAvaliacao($idAvaliacao);
    
    $rowCabecalhoAvaliacao = mysqli_fetch_assoc($resultCabecalhoAvaliacao);

    $nomeAvaliador      = $rowCabecalhoAvaliacao['nome_avaliador'];
    $dataHoraAvaliacao  = $rowCabecalhoAvaliacao['data_hora_avaliacao'];
    $versaoArtefato     = $rowCabecalhoAvaliacao['versao_artefato'];

?>

<body class="body">
<?php 
    usarComponenteComParametros('barra_navegacao', ['vermelho']); 
?>

<div class="container-conteudo">
    <div class="container-titulo-versao">
        <h1 class="titulo">Cadastro de avaliação de template</h1>
        <h1 class="versao">Versão template: <?=$versao_template?>.0</h1>
    </div>

    <form id="formCadAvaliacaoTemplate" action="./action/cadastrarAvaliacao.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="autor" class="form-label input_text_form-label">Autor da versão atual do template:</label>
            <input type="text" class="form-control" id="autor" name="autor" disabled value="<?=$autor?>">
        </div>

        <div class="mb-3">
            <label for="tituloTemplate" class="form-label input_text_form-label">Artefato do template:</label>
            <input type="text" class="form-control" id="tituloTemplate" name="tituloTemplate" value="<?=$tituloTemplate?>" disabled>
        </div>

        <div class="mb-3">
            <label for="nome_avaliador" class="form-label input_text_form-label">Nome do avaliador:</label>
            <input type="text" class="form-control" id="nome_avaliador" name="nome_avaliador" value="<?=$nomeAvaliador?>" disabled>
        </div>

        <div class="mb-3">
            <label for="versao_artefato" class="form-label input_text_form-label">Versão do artefato:</label>
            <input type="text" class="form-control" id="versao_artefato" name="versao_artefato" value="<?=$versaoArtefato?>" disabled>
        </div>

        <div class="mb-3">
            <label for="data_hora_avaliacao" class="form-label input_text_form-label">Data e hora da avaliação:</label>
            <input type="datetime-local" class="form-control" id="data_hora_avaliacao" name="data_hora_avaliacao" value="<?=$dataHoraAvaliacao?>" disabled>
        </div>

        <div class="mb-3">
            <?php
                $contador = 0;
                foreach ($matrizChecklistItems as $arrayChecklistItem) {

                    $idChecklistItem = $arrayChecklistItem[4];
                    $descricao       = $arrayChecklistItem[0];
                    $nome_responsavel_correcao = $arrayChecklistItem[1];

                    $atributoSelectedGravidadeBaixa = ($arrayChecklistItem[2] == 'Baixa') ? 'selected' : '';
                    $atributoSelectedGravidadeMedia = ($arrayChecklistItem[2] == 'Média') ? 'selected' : '';
                    $atributoSelectedGravidadeAlta  = ($arrayChecklistItem[2] == 'Alta' ) ? 'selected' : '';

                    $prazo_em_dias = $arrayChecklistItem[3];

                    $resultAvaliacaoChecklistItem = buscarResultadoAvaliacaoItemChecklistEspecifico($idAvaliacao, $idChecklistItem);
                    $rowAvaliacaoChecklistItem = mysqli_fetch_assoc($resultAvaliacaoChecklistItem);

                    $isConformeAtributoChecked  = ($rowAvaliacaoChecklistItem['isConforme'] == 1) ? 'checked' : '';
                    $observacao = $rowAvaliacaoChecklistItem['observacao'];

                    echo <<<END
                        <div class="container-checklist-item mb-3">

                            <input type="hidden" name="idChecklistItem$contador" value="$idChecklistItem">

                            <div class="mb-3">
                                <label for="descricao$contador" class="form-label input_text_form-label">Descrição:</label>
                                <input type="text" class="form-control" id="descricao$contador" name="descricao$contador" disabled value="$descricao">
                            </div>
            
                            <div class="mb-3">
                                <label for="nomeResponsavelCorrecao$contador" class="form-label input_text_form-label">Nome do responsável pela correção:</label>
                                <input type="text" class="form-control" id="nomeResponsavelCorrecao$contador" name="nomeResponsavelCorrecao$contador" disabled value="$nome_responsavel_correcao">
                            </div>
            
                            <div class="mb-3">
                                <label for="gravidade$contador" class="form-label">Gravidade da não-conformidade:</label>
                                <select class="form-select" name="gravidade$contador" id="gravidade$contador" disabled>
                                    <option value="1" $atributoSelectedGravidadeBaixa>Baixa</option>
                                    <option value="2" $atributoSelectedGravidadeMedia>Média</option>
                                    <option value="3" $atributoSelectedGravidadeAlta >Alta</option>
                                </select>
                            </div>
            
                            <div class="mb-3">
                                <label for="prazoDias$contador" class="form-label">Prazo em dias para atender a não-conformidade:</label>
                                <input class="form-control" type="number" name="prazoDias$contador" id="prazoDias$contador" step=1 disabled value="$prazo_em_dias">
                            </div>

                            <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="isConforme$contador" name="isConforme$contador" $isConformeAtributoChecked disabled>
                                <label class="form-check-label" for="isConforme$contador">
                                    Está conforme
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for="observacao$contador" class="form-label">Observação:</label>
                                <textarea class="form-control" id="observacao$contador" name="observacao$contador" rows="3" disabled>$observacao</textarea>
                            </div>

                            

                        </div>
                    END;
                    $contador++;
                }       
            ?>
        </div>

        <div>
            <a href="../pagina_principal/index.php" class="botao-cancelar">
                <button type="button" class="btn btn-success" id="cancelar" 
                    name="cancelar">
                    Voltar
                </button>
            </a>
        </div>
    </form>

</div>
</body>
</html>