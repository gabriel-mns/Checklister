<?php

    #Imports
    //require("conexaoBancoDados.php");

    /*

        MÉTODOS DE BUSCA

    */
    function buscarResultadoAvaliacaoItemChecklistEspecifico(int $idAvaliacao, int $idChecklistItem) {

        global $conn;

        $queryBuscarResultadoChecklistItem = 
            <<<END
                SELECT * FROM avaliacao_checklist_item WHERE id_avaliacao = $idAvaliacao AND id_checklist_item = $idChecklistItem;
            END;

        return mysqli_query($conn, $queryBuscarResultadoChecklistItem);

    }

    function buscarCabecalhoAvaliacao(int $idAvaliacao) {
        
        global $conn;

        $queryBuscarCabecalho = "SELECT * FROM avaliacao WHERE id_avaliacao =". $idAvaliacao;

        return mysqli_query($conn, $queryBuscarCabecalho);

    }

    function buscarTodosTemplatesCadastrados() {

        global $conn;

        $queryBuscarTodosTemplates =
            <<<END
                SELECT *
                FROM checklist;
            END;
        
        return mysqli_query($conn, $queryBuscarTodosTemplates);
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
    
    function buscarTodasAvaliacoes(){

        global $conn;

        $queryBusca = "SELECT * FROM avaliacao";

        return mysqli_query($conn, $queryBusca);

    }

    function buscarDadosAvaliacaoEChecklist(){

        global $conn;

        $queryBusca = "
            SELECT 
                c.titulo titulo, 
                a.data_hora_avaliacao data_hora_avaliacao,
                c.versao_checklist versao_checklist,
                a.nome_avaliador nome_avaliador,
                a.id_avaliacao id_avaliacao,
                c.id_checklist id_checklist
            FROM 
                avaliacao a 
                INNER JOIN checklist c 
                ON a.id_checklist = c.id_checklist;
            ";

        return mysqli_query($conn, $queryBusca);

    }

    function buscarQtdeAvaliacoesDaAvaliacao($idAvaliacao){

        global $conn;

        $queryBuscaQtde = "SELECT COUNT(*) FROM avaliacao_checklist_item WHERE id_avaliacao =" . $idAvaliacao;

        return mysqli_query($conn, $queryBuscaQtde);

    }

    function buscarResultadosAvaliacao(int $idAvaliacao){

        global $conn;

        $queryBuscarResultados = "SELECT isConforme FROM avaliacao_checklist_item WHERE id_avaliacao =". $idAvaliacao;

        return mysqli_query($conn, $queryBuscarResultados);

    }

    function buscarQtdeAvaliacaoComTemplate($idTemplate){

        global $conn;

        $queryBuscarResultados = "SELECT COUNT(*) FROM avaliacao WHERE id_checklist =". $idTemplate;

        return mysqli_query($conn, $queryBuscarResultados);

    }



    /*

        MÉTODOS DE ATUALIZAR

    */

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

    function atualizarTemplate($idTemplate,$nomeAutorVersao, $tituloTemplate, $checklistItemsDeletar, $checklistItemsAtualizar, $checklistItemsInserir){

        global $conn;

        mysqli_begin_transaction($conn);

        //Atualiza a tabela CHECKLIST
        atualizarDadosChecklist($idTemplate, $tituloTemplate, $nomeAutorVersao);

        //Para cada item a ser deletado, deleta o item
        foreach($checklistItemsDeletar as $itemDeletar){

            //$itemDeletar[0] é o id_checklist_item
            removerChecklistItem($itemDeletar[0]);

        }

        //Para cada item a ser deletado, deleta o item
        foreach($checklistItemsAtualizar as $itemAtualizar){

            atualizarDadosCheckListItem(
                $itemAtualizar[0], //id_checklist_item
                $itemAtualizar[1], //descricao
                $itemAtualizar[2], //nomeResponsavelCorrecao
                $itemAtualizar[3], //gravidade
                $itemAtualizar[4]  //prazoDias
            );

        }

        //Para cada item a ser deletado, deleta o item
        foreach($checklistItemsInserir as $itemCadastrar){

            cadastrarChecklistItem(
                $itemCadastrar[0], //id_checklist
                $itemCadastrar[1], //descricao
                $itemCadastrar[2], //nomeRespCorrecao
                $itemCadastrar[3], //gravidade
                $itemCadastrar[4] == '' ? 1 : $itemCadastrar[4]  //prazoEmDias
            );

        }
    

        mysqli_commit($conn);

    }

    
    /*

        MÉTODOS DE CADASTRAR

    */
    function cadastrarChecklistItem($idChecklist, string $descricao, string $nomeRespCorrecao, string $gravidade, int $prazoDias){

        global $conn;

        $queryInsert = <<<END

            INSERT INTO
                checklist_item (id_checklist, descricao, nome_responsavel_correcao, gravidade_nao_conformidade, prazo_em_dias)
            VALUES(
                $idChecklist,
                '$descricao',
                '$nomeRespCorrecao',
                '$gravidade',
                $prazoDias
            )

        END;

        mysqli_query($conn,$queryInsert);

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

    function calcularAderenciaDaAvaliacao(int $idAvaliacao){

        $resultados = buscarResultadosAvaliacao($idAvaliacao);
        $qtdeChecklistItems = mysqli_fetch_array(buscarQtdeAvaliacoesDaAvaliacao($idAvaliacao))[0];
        $qtdeDeResultadosConformes = 0;

        while($resultado = mysqli_fetch_assoc($resultados)){

            if($resultado["isConforme"] == 1) $qtdeDeResultadosConformes++;

        }

        $taxa = ($qtdeDeResultadosConformes/$qtdeChecklistItems) * 100;
        $taxaFormatada = number_format($taxa,1,",",".");

        return $taxaFormatada;

    }


    /*

        MÉTODOS DE REMOÇÃO

    */

    function removerChecklistItem(int $idChecklistItem){

        global $conn;

        $queryRemocao = "

            DELETE FROM
                checklist_item
            WHERE
                id_checklist_item = $idChecklistItem;

        ";

        mysqli_query($conn, $queryRemocao);

    }




?>
    

