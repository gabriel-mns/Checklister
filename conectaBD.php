<?php

    global $servername ;
    global $username;
    global $password;
    global $database;

    $servername = "localhost:3307";
    $username = "root";
    $password = "PUC@1234";
    $database = "CHECKLISTER";

    try{
        $conn = mysqli_connect($servername, $username, $password, $database);
    
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
?>