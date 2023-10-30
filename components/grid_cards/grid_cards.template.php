<?php 
    $tipoGrid = $_SESSION['parametrosComponente'][0]; #template, avaliacao

    if ($tipoGrid == "template") {
        echo <<<END
            <div class="grid_cards-container-cards"> 
        END; 
            usarComponenteComParametros('card', ['novoTemplate']);

            $result = buscarTodosTemplatesCadastrados();

            while($row = mysqli_fetch_assoc($result)) {
                usarComponenteComParametros('card', ['templateJaCadastrado', $row["titulo"], $row["data_hora_criacao"], $row["versao_checklist"], $row["autor_vesao"]]);
            }   
            // usarComponenteComParametros('card', ['templateJaCadastrado', 'Template Plano de Projeto', '01/01/2023', 'v1', 'Carlos Eduardo']);
            // usarComponenteComParametros('card', ['templateJaCadastrado', 'Plano de Projeto', '01/01/2023', 'v1', 'Carlos Eduardo']);
            // usarComponenteComParametros('card', ['templateJaCadastrado', 'Plano de Projeto', '01/01/2023', 'v1', 'Carlos Eduardo']);
            // usarComponenteComParametros('card', ['templateJaCadastrado', 'Plano de Projeto', '01/01/2023', 'v1', 'Carlos Eduardo']);
            // usarComponenteComParametros('card', ['templateJaCadastrado', 'Plano de Projeto', '01/01/2023', 'v1', 'Carlos Eduardo']);
        echo <<<END
            </div>
        END; 
    }
?>