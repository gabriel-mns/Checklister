<?php

    //Imports
    include('../../../framework/checklister_framework.php');

    //Redirecionar caso essa página esteja sendo acessada por GET
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../pagina_principal/index.php");
        exit();
    }

    // Dados gerais da avaliação
    $nomeAvaliador  = $_POST["nome_avaliador"];
    $versaoArtefato = $_POST["versao_artefato"];
    $idChecklist    = $_POST["id_checklist"];
    $arrayChecklistItemsAvaliados = [];

    $contador = 0;

    // Adiciona todos os itens avaliados ao array
    do {

        $arrayChecklistItemAtual = [];

        array_push($arrayChecklistItemAtual,   $_POST["idChecklistItem"     . $contador]);
        array_push($arrayChecklistItemAtual,   isset($_POST["isConforme"          . $contador]));
        array_push($arrayChecklistItemAtual,   $_POST["observacao"          . $contador]);

        array_push($arrayChecklistItemsAvaliados, $arrayChecklistItemAtual);

        $contador += 1;

    } while(isset($_POST["idChecklistItem" . $contador]));

    try {

        cadastrarAvaliacaoCompleta($nomeAvaliador, $versaoArtefato, $idChecklist, $arrayChecklistItemsAvaliados);

    } catch(Exception $e) { // Caso haja algum erro inserindo os dados 
        
        echo 'Ocorreu um erro durante a inserção.';
        mysqli_rollback($conn); // Desfazer transaction
        // alert("Houve um erro ao cadastrar o usuário. Tente novamente mais tarde.");
    }
    
    header("Location: ../../pagina_principal/index.php");
?>