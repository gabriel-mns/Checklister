<?php

    //IMPORTS
    include('../../framework/checklister_framework.php');

    //ID do checklist que será editado
    $idTemplate = $_GET["idTemplate"] ?? 1;

    //Dados do template que será editado
    $template = mysqli_fetch_assoc(buscarDadosDaChecklist($idTemplate));

    //Checklist items do template
    $checklistItems = buscarCheckListItemsDaChecklist($idTemplate);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar template - Checklister</title>

    <!-- Imports obrigatórios para todas as páginas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./pagina_edicao_template.css">
</head>

<body class="body">
<?php 
    usarComponenteComParametros('barra_navegacao', ['vermelho']); 
?>

<div class="container-conteudo">
    <div class="container-titulo-versao">
        <h1 class="titulo">Edição de template</h1>
        <h1 class="versao">Versão <?= $template["versao_checklist"]?>.0</h1>
    </div>

    <form id="formCadTemplate" action="./action/editarTemplate.php" method="post" enctype="multipart/form-data">
        <?php 
            usarComponenteComParametros('input_text_form', ['Autor da versão atual:', 'autor', $template["autor_versao"]]); 
            usarComponenteComParametros('input_text_form', ['Título do artefato:', 'titulo', $template["titulo"]]); 
        ?>
        
        <hr>

        <input type="hidden" name="idTemplate" value="<?=$idTemplate?>">

        <div class="mb-3">
            <div class="mb-3">
                <button 
                    type="button" 
                    class="btn btn-success" 
                    id="btn_novo_checklist_item" 
                    name="btn_novo_checklist_item"
                    onclick="adicionarNovoChecklistItem()"
                >
                    +
                </button>
                <label for="btn_novo_checklist_item label-adicionar-novo-item">
                    <span>Adicionar novo item de checklist</span>
                </label>
            </div>

            <div id="div-insercao">

                <?php

                    $contador = 1;

                    while($checklistItem = mysqli_fetch_assoc($checklistItems)){

                        $idChecklistItem = $checklistItem["id_checklist_item"];
                        $descricao = $checklistItem["descricao"];
                        $nomeResponsavelCorrecao = $checklistItem["nome_responsavel_correcao"];
                        $gravidadeNaoConformidade = $checklistItem["gravidade_nao_conformidade"];
                        $prazoEmDias = $checklistItem["prazo_em_dias"];

                        $atributoSelectedGravidadeBaixa = ($gravidadeNaoConformidade == 'Baixa') ? 'selected' : '';
                        $atributoSelectedGravidadeMedia = ($gravidadeNaoConformidade == 'Média') ? 'selected' : '';
                        $atributoSelectedGravidadeAlta  = ($gravidadeNaoConformidade == 'Alta' ) ? 'selected' : '';
    

                        echo <<<END
                        <div class="container-checklist-item mb-3">
                        
                            <input type="hidden" name="checklistItemId$contador" value="$idChecklistItem">

                            <div class="mb-3">
                                <label for="descricao$contador" class="form-label input_text_form-label">Descrição: </label>
                                <input type="text" class="form-control" id="descricao$contador" name="descricao$contador" value="$descricao">
                            </div>

                            <div class="mb-3">
                                <label for="nomeResponsavelCorrecao$contador" class="form-label input_text_form-label">Nome do responsável pela correção: </label>
                                <input type="text" class="form-control" id="nomeResponsavelCorrecao$contador" name="nomeResponsavelCorrecao$contador" value="$nomeResponsavelCorrecao">
                            </div>


                            <div class="mb-3">
                                <label for="gravidade$contador" class="form-label">Gravidade da não-conformidade:</label>
                                <select class="form-select" name="gravidade$contador" id="gravidade$contador">
                                    <option value="1" $atributoSelectedGravidadeBaixa >Baixa</option>
                                    <option value="2" $atributoSelectedGravidadeMedia >Média</option>
                                    <option value="3" $atributoSelectedGravidadeAlta  >Alta</option>
                                </select>
                            </div>

                            
                            <div class="mb-3">
                                <label for="prazoDias$contador" class="form-label">Prazo em dias para atender a não-conformidade:</label>
                                <input class="form-control" type="number" name="prazoDias$contador" id="prazoDias$contador" step=1 value="$prazoEmDias">
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" name="deletar$contador">
                                <label for="deletar$contador"> Apagar item?</label>
                            </div>


                        </div>
                        END;

                        $contador++;

                    }

                    echo "<input type='hidden' id='lastChecklistItem' value=" . $contador . ">";

                ?>

            </div> <!-- Aqui que pagina_cadastro_template.js vai adicionar novos checklist items ao clicar no botão de Adicionar -->
        </div>

        <div>
            <button type="submit" class="btn btn-success" id="salvar" 
                name="salvar">
                Salvar
            </button>
            <a href="../pagina_principal/index.php" class="botao-cancelar">
                <button type="button" class="btn btn-outline-danger" id="cancelar" 
                    name="cancelar">
                    Cancelar
                </button>
            </a>
        </div>
    </form>

</div>

<script src="./pagina_edicao_template.js"></script>
</body>
</html>