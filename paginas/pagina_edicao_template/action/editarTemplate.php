<?php
    include('../../../framework/checklister_framework.php');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../pagina_principal/index.php");
        exit();
    }

    $idTemplate                             = $_POST["idTemplate"];
    $nomeAutorVersao                        = $_POST["autor"];
    $tituloTemplate                         = $_POST["titulo"];
    $checklistItemsDeletar                  = [];
    $checklistItemsAtualizar                = [];
    $checklistItemsInserir                  = [];        
    $contador                               = 1;

    do {
        
        $itemAtual = [];
        
        array_push($itemAtual,          $_POST["descricao"                  . $contador]);
        array_push($itemAtual,          $_POST["nomeResponsavelCorrecao"    . $contador]);
        array_push($itemAtual,          $_POST["gravidade"                  . $contador]);
        array_push($itemAtual,          $_POST["prazoDias"                  . $contador]);

        //Se exite o ID do checklistItem, insere ele nos dados;
        if(isset($_POST["checklistItemId". $contador])){

            //Insere no array de inserir
            array_unshift($itemAtual, $_POST["checklistItemId". $contador]);

        }

        //Checkbox "deletar" marcado
        $deletarAtual = isset($_POST["deletar" . $contador]);

        //Se for para deletar
        if($deletarAtual){

            //Insere o idTemplate
            array_unshift($itemAtual,$_POST["checklistItemId". $contador]);

            //Insere no array de deletar
            array_push($checklistItemsDeletar, $itemAtual, $idTemplate);

        //Se for para atualizar
        } else if(isset($_POST["checklistItemId". $contador])) {

            //Insere no array de atualizar
            array_push($checklistItemsAtualizar, $itemAtual );

        } else {

            //Insere o idTemplate
            array_unshift($itemAtual,$idTemplate);

            //Insere no array de inserir
            array_push($checklistItemsInserir, $itemAtual );

        }
        
        $contador += 1;

    } while(isset($_POST["descricao" . $contador]));


    try {
        
        atualizarTemplate($idTemplate,$nomeAutorVersao, $tituloTemplate, $checklistItemsDeletar, $checklistItemsAtualizar, $checklistItemsInserir);

    } catch(Exception $e) { // Caso haja algum erro inserindo os dados 

        echo 'Ocorreu um erro durante a atualização.';
        mysqli_rollback($conn); // Desfazer transaction
        // alert("Houve um erro ao cadastrar o usuário. Tente novamente mais tarde.");

    }
    
    header("Location: ../../pagina_principal/index.php");
?>