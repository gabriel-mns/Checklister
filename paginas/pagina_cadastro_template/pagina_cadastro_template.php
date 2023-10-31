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
    <link rel="stylesheet" href="./pagina_cadastro_template.css">
    <script src="./pagina_cadastro_template.js"></script>
</head>

<body class="body">
<?php 
    usarComponenteComParametros('barra_navegacao', ['vermelho']); 
?>

<div class="container-conteudo">
    <div class="container-titulo-versao">
        <h1 class="titulo">Cadastro de template</h1>
        <h1 class="versao">Versão 1.0</h1>
    </div>

    <form id="formCadTemplate" action="./action/cadastrarTemplate.php" method="post" enctype="multipart/form-data">
        <?php 
            usarComponenteComParametros('input_text_form', ['Autor da versão atual:', 'autor']); 
            usarComponenteComParametros('input_text_form', ['Título do artefato:', 'titulo']); 
        ?>
        
        <hr>

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
            
            <div class="container-checklist-item">
                <?php
                    usarComponenteComParametros('input_text_form', ['Descrição:', 'descricao0']);
                    usarComponenteComParametros('input_text_form', ['Nome do responsável pela correção:', 'nomeResponsavelCorrecao0']);
                ?>

                <div class="mb-3">
                    <label for="gravidade0" class="form-label">Gravidade da não-conformidade:</label>
                    <select class="form-select" name="gravidade0" id="gravidade0">
                        <option value="1">Baixa</option>
                        <option value="2">Média</option>
                        <option value="3"selected>Alta</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="prazoDias0" class="form-label">Prazo em dias para atender a não-conformidade:</label>
                    <input class="form-control" type="number" name="prazoDias0" id="prazoDias0" step=1>
                </div>
            </div>

            <div id="div-insercao"></div> <!-- Aqui que pagina_cadastro_template.js vai adicionar novos checklist items ao clicar no botão de Adicionar -->
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
</body>
</html>