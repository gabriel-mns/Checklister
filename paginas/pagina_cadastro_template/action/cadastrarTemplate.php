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

        $contador += 1;
    } while(isset($_POST["descricao" . $contador]));

    $insertQueryTabelaChecklist = 
        <<<END
            INSERT INTO checklist (titulo, data_hora_criacao, autor_vesao, versao_checklist) 
            VALUES ("$tituloTemplate", NOW(), "$nomeAutorVersao", 1);
        END;

    mysqli_begin_transaction($conn);

    try {
        mysqli_query($conn, $insertQueryTabelaChecklist);

        $idGeradoAutomaticamenteTabelaChecklist = mysqli_insert_id($conn);

        $insertQueryTabelaChecklistItem = 
            <<<END
                INSERT INTO checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias) VALUES 
            END;

        for ($i = 0; $i < count($arrayDescricao); $i++) {
            $insertQueryTabelaChecklistItem .= 
                <<<END
                    (
                        $idGeradoAutomaticamenteTabelaChecklist,
                        "$arrayDescricao[$i]",
                        "$arrayNomeResponsavelCorrecao[$i]",
                        "$arrayGravidadeNaoConformidade[$i]",
                        $arrayPrazoDiasAtenderNaoConformidade[$i]
                    )
                END;
            if ($i == (count($arrayDescricao) - 1)) {
                $insertQueryTabelaChecklistItem .=
                    <<<END
                        ;
                    END;
            } else {
                $insertQueryTabelaChecklistItem .=
                    <<<END
                        ,
                    END;
            }
        }

        echo $insertQueryTabelaChecklistItem;

        mysqli_query($conn, $insertQueryTabelaChecklistItem);
        

        // alert("Usuário cadastrado com sucesso!");
        mysqli_commit($conn); 

    } catch(Exception $e) { // Caso haja algum erro inserindo os dados 
        echo 'Ocorreu um erro durante a inserção.';
        mysqli_rollback($conn); // Desfazer transaction
        // alert("Houve um erro ao cadastrar o usuário. Tente novamente mais tarde.");
    }
    

?>