<?php 
    $tipoGrid = $_SESSION['parametrosComponente'][0]; #template, avaliacao

    if ($tipoGrid == "template") {
        imprimirCardsPaginaTemplates();
    }
    if ($tipoGrid == "avaliacao") {
        imprimirCardsPaginaAvaliacoes();
    }



    
    function imprimirCardsPaginaTemplates() {
        echo <<<END
            <div class="grid_cards-container-cards"> 
        END; 
                imprimirCardCadastroNovoTemplate();
                imprimirCardsTemplatesCadastrados();          
        echo <<<END
            </div>
        END; 
    };

    function imprimirCardCadastroNovoTemplate() {
        usarComponenteComParametros('card', ['novoTemplate']);
    }

    function imprimirCardsTemplatesCadastrados() {
        $result = buscarTodosTemplatesCadastrados();

        while($row = mysqli_fetch_assoc($result)) {
            usarComponenteComParametros('card', ['templateJaCadastrado', $row["titulo"], $row["data_hora_criacao"], $row["versao_checklist"], $row["autor_versao"], $row["id_checklist"]]);
        }  
    }

    function imprimirCardsPaginaAvaliacoes() {

        echo <<<END
            <div class="grid_cards-container-cards"> 
        END; 
                imprimirCardsTemplatesAvaliados();          
        echo <<<END
            </div>
        END; 
    }

    function imprimirCardsTemplatesAvaliados() {
        #$result = buscarTodosTemplatesAvaliados();

        $avaliacoes = buscarDadosAvaliacaoEChecklist();
        
        while($row = mysqli_fetch_assoc($avaliacoes)) {

            $taxaAderencia = calcularAderenciaDaAvaliacao($row["id_avaliacao"]);

            usarComponenteComParametros('card', ['avaliacao', $row["titulo"], $row["data_hora_avaliacao"], $row["versao_checklist"], $row["nome_avaliador"], $row["id_checklist"], $row["id_avaliacao"], $taxaAderencia]);
        }  

        //usarComponenteComParametros('card', ['avaliacao', "Avaliação 1", "01/01/2000", "v5", "Rogério Seni"]);

    }
?>