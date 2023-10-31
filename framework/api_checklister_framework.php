<?php

    #Imports
    //require("conexaoBancoDados.php");

    function buscarTodosTemplatesCadastrados() {

        global $conn;

        $queryBuscarTodosTemplates =
            <<<END
                SELECT *
                FROM checklist;
            END;
        
        return mysqli_query($conn, $queryBuscarTodosTemplates);
    }

    function buscarTodosItensChecklistDaChecklist(int $idChecklist) {

        global $conn;

        $queryBuscarTodosItensChecklistDaChecklist = 
            <<<END
                SELECT *
                FROM CHECKLIST_ITEM
                WHERE
                    id_checklist = $idChecklist;
            END;

        return mysqli_query($conn, $queryBuscarTodosItensChecklistDaChecklist);

    }

    function buscarTodosOsItensAvaliacaoDaAvaliacao(int $idAvaliacao){

        global $conn;

        $queryBuscarTodosOsItensAvaliacaoDaAvaliacao = 
            <<<END
                SELECT *
                FROM AVALIACAO_CHECKLIST_ITEM
                WHERE
                    id_avaliacao = $idAvaliacao;
            END;

        return mysqli_query($conn, $queryBuscarTodosOsItensAvaliacaoDaAvaliacao);

    }

    function atualizarDadosChecklist(int $idChecklist, string $titulo, string $autorVersao){

        global $conn;

        // Inicia a transação de edição
        mysqli_begin_transaction($conn);

        $dadosDaChecklist = mysqli_fetch_assoc(buscarDadosDaChecklist($idChecklist));

        $versaoDaNovaChecklist = $dadosDaChecklist['versao_checklist']+1;

        $queryAlterarDadosChecklist = 
        "
            UPDATE 
                checklist
            SET 
                titulo = '{$titulo}',
                data_hora_criacao = NOW(),
                versao_checklist = {$versaoDaNovaChecklist},
                autor_versao = '{$autorVersao}'
            WHERE
                id_checklist = {$idChecklist};
        ";
        
        mysqli_query($conn, $queryAlterarDadosChecklist);
        
        mysqli_commit($conn);
        // Termina a transação de edição

    }

    function atualizarDadosCheckListItem(
            int $idChecklistItem,
            string $descricao, 
            string $nomeResponsavelCorrecao,
            string $gravidadeNaoConformidade,
            int $prazoEmDias
        ){

        global $conn;
        
        // Inicia a transação de edição
        mysqli_begin_transaction($conn);

        $queryAlterarDadosChecklist = 
        "
            UPDATE
                checklist_item
            SET 
                descricao = '{$descricao}',
                nome_responsavel_correcao = '{$nomeResponsavelCorrecao}',
                gravidade_nao_conformidade = '{$gravidadeNaoConformidade}',
                prazo_em_dias = {$prazoEmDias}
            WHERE
                id_checklist_item = {$idChecklistItem};
        ";
        
        mysqli_query($conn, $queryAlterarDadosChecklist);
        
        mysqli_commit($conn);
        // Termina a transação de edição

    }

    function buscarDadosChecklistItem(int $idChecklistItem){

        global $conn;

        $querySelectDadosChecklist = "SELECT * FROM checklist_item WHERE id_checklist_item = " . $idChecklistItem;

        return mysqli_query($conn, $querySelectDadosChecklist);
        
    }

    function buscarDadosDaChecklist(int $idChecklist){

        global $conn;

        $querySelectDadosChecklist = "SELECT * FROM checklist WHERE id_checklist = " . $idChecklist;

        return mysqli_query($conn, $querySelectDadosChecklist);

    }

    function buscarCheckListItemsDaChecklist(int $idChecklist){

        global $conn;

        $querySelectTodosChecklistItems = "SELECT * FROM checklist_item WHERE id_checklist = " . $idChecklist;

        return mysqli_query($conn,$querySelectTodosChecklistItems);

    }

    function cadastrarAvaliacao(string $nomeAvaliador, string $versaoArtefato, int $idChecklist){

        global $conn;

        $queryInsertAvalicao = "

            INSERT INTO
                avaliacao (id_checklist, data_hora_avaliacao, versao_artefato, nome_avaliador)
            VALUES(
                {$idChecklist},
                NOW(),
                '{$versaoArtefato}',
                '{$nomeAvaliador}'
            ) 
            
        ";

        mysqli_query($conn, $queryInsertAvalicao);

    }
    
    function cadastrarAvaliacaoChecklistItem(int $idAvaliacao, int $idChecklistItem, bool $isConforme, string $observacao){

        global $conn;

        $isConforme = $isConforme? '1' : '0';

        $queryInsertChecklistItem = "

            INSERT INTO
                avaliacao_checklist_item (id_avaliacao, id_checklist_item, isConforme, observacao)
            VALUES(
                {$idAvaliacao},
                {$idChecklistItem},
                {$isConforme},
                '{$observacao}'
            ) 
            
        ";

        mysqli_query($conn, $queryInsertChecklistItem);

    }

    function cadastrarAvaliacaoCompleta(string $nomeAvaliador, string $versaoArtefato, int $idChecklist, array $avaliacoes){

        global $conn;

        //Começa a transaction de cadastrar Avaliação com Itens Avaliados
        mysqli_begin_transaction($conn);

        cadastrarAvaliacao($nomeAvaliador, $versaoArtefato, $idChecklist);

        $idAvaliacao     = mysqli_insert_id($conn);

        // Para cada avaliacao no array de avaliações, inserir avaliação no banco.
        foreach($avaliacoes as $itensDeAvaliacao){

            $idChecklistItem = $itensDeAvaliacao[0];
            $isConforme      = $itensDeAvaliacao[1];
            $observacao      = $itensDeAvaliacao[2];

            cadastrarAvaliacaoChecklistItem($idAvaliacao, $idChecklistItem, $isConforme, $observacao);

        }

        //Commita a transaction de cadastrar Avaliação com Itens Avaliados
        mysqli_commit($conn);
    }

?>
