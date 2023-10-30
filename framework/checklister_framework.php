<?php 
    #Imports
    include("conexaoBancoDados.php");

    #Declaração e atribuição das variáveis globais
    $DIRETORIO_RAIZ = $_SERVER['DOCUMENT_ROOT'] . '/Checklister';

    #Código de inicialização do framework
    inicializarFramework();

    #Funções do framework
    function inicializarFramework() {
        session_start();
        conectarBancoDados();
    }

    function usarComponente($nomeComponente) {
        global $DIRETORIO_RAIZ;

        $rotaComum = $DIRETORIO_RAIZ . '/components/' . $nomeComponente . '/' . $nomeComponente;

        $rotaComponenteTemplate = $rotaComum . '.template.php';
        $rotaComponenteStyles = $rotaComum . '.styles.css';
        $rotaComponenteBehavior = $rotaComum . '.behavior.js';

        adicionarEstiloNoHeadPorRota($rotaComponenteStyles);
        include($rotaComponenteTemplate);
        adicionarBehaviorNoHeadPorRota($rotaComponenteBehavior);
        #include($rotaComponenteBehavior);

    }

    function usarComponenteComParametros($nomeComponente, $arrayParametros) {
        unset($_SESSION['parametrosComponente']);
        $_SESSION['parametrosComponente'] = $arrayParametros;
        usarComponente($nomeComponente);
    }

    function adicionarEstiloNoHeadPorRota($rotaEstilo) {
        echo <<<END
            <script>
                var style = document.createElement('style');
                style.type = 'text/css';
                
                var cssRule = `
        END; 
                    include($rotaEstilo); 
        echo <<<END
                    `;
                style.appendChild(document.createTextNode(cssRule));
                document.head.appendChild(style);
            </script>
        END;
    }

    function adicionarBehaviorNoHeadPorRota($rotaBehavior) {
        echo <<<END
            <script>         
        END; 
                include($rotaBehavior); 
        echo <<<END
            </script>
        END;
    }
?>