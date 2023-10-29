<?php
    #Declaração e atribuição das variáveis globais
    $SGBD_SERVERNAME = "localhost:3306";
    $SGBD_USERNAME = "root";
    $SGBD_PASSWORD = "";
    $SGBD_DATABASE = "checklister";

    function conectarBancoDados() {
        global $SGBD_SERVERNAME;
        global $SGBD_USERNAME;
        global $SGBD_PASSWORD;
        global $SGBD_DATABASE;

        try{
            $conn = mysqli_connect($SGBD_SERVERNAME, $SGBD_USERNAME, $SGBD_PASSWORD, $SGBD_DATABASE);
        
            if($conn){
                echo "<script>console.log(\"Conexão com banco de dados realizada com sucesso.\")</script>";
            } else {
                echo "<h1>Ocorreu um erro.</h1>";
                echo "<p>Houve um erro ao se conectar com o banco de dados. Por favor, tente novamente mais tarde.</p>";
                echo "<script>console.log(\"".(mysqli_connect_error())."\")</script>";
            }
        }
        catch(mysqli_sql_exception $e){
            echo "<h1>Ocorreu um erro.</h1>";
            echo "<p>Houve um erro ao se conectar com o banco de dados. Por favor, tente novamente mais tarde.</p>";
            echo "<script>console.log(\"".($e->getMessage())."\")</script>";
        }
    }
?>