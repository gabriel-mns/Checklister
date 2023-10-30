<?php
    include('../../../framework/checklister_framework.php');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect("../../pagina_principal/index.php");
    }

    $nomeAutorVersao                        = $_POST["autor"];
    $tituloTemplate                         = $_POST["titulo"];
    $arrayDescricao                         = [];
    $arrayNomeResponsavelCorrecao           = [];
    $arrayGravidadeNaoConformidade          = [];
    $arrayPrazoDiasAtenderNaoConformidade   = [];
    $contador                               = 0;

    do {
        array_push($arrayDescricao,                         $_POST["descricao"                  . $contador]);
        array_push($arrayNomeResponsavelCorrecao,           $_POST["nomeResponsavelCorrecao"    . $contador]);
        array_push($arrayGravidadeNaoConformidade,          $_POST["gravidade"                  . $contador]);
        array_push($arrayPrazoDiasAtenderNaoConformidade,   $_POST["prazoDias"                  . $contador]);

        $contador = $contador + 1;
    } while(isset($_POST["descricao" . $contador]));

    $insertQueryTabelaChecklist = 
        <<<END
            INSERT INTO checklist (titulo, data_hora_criacao, autor_vesao, versao_checklist) 
            VALUES ("$tituloTemplate", NOW(), "$nomeAutorVersao", 1);
        END;
    
    echo $insertQueryTabelaChecklist;

    mysqli_begin_transaction($conn);

    // Tenta realizar INSERTs
    try {
        // Inserir na tabela CHECKLIST
        mysqli_query($conn, $insertQueryTabelaChecklist);

        // Obter ID gerado automaticamente na inserção na tabela CHECKLIST
        $idGeradoAutomaticamenteTabelaChecklist = mysqli_insert_id($conn);

        // $insertQueryTabelaChecklist = 
        //     <<<END
        //         INSERT INTO checklist (titulo, data_hora_criacao, autor_vesao, versao_checklist) 
        //         VALUES ("$tituloTemplate", NOW(), "$nomeAutorVersao", 1);
        //     END;

        // alert("Usuário cadastrado com sucesso!");
        mysqli_commit($conn); 

    } catch(Exception $e) { // Caso haja algum erro inserindo os dados 
        echo 'Ocorreu um erro durante a inserção.';
        mysqli_rollback($conn); // Desfazer transaction
        // alert("Houve um erro ao cadastrar o usuário. Tente novamente mais tarde.");
    }
    

?>