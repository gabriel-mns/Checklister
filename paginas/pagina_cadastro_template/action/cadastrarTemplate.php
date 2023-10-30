<?php
    include('../../../framework/checklister_framework.php');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect("../../pagina_principal/index.php");
    }

    $nomeAutor                              = $_POST["autor"];
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
        echo 'olá';
    } while(isset($_POST["descricao" . $contador]));

    
?>