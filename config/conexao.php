<?php
    try{
        DEFINE("SERVIDOR","localhost");
        DEFINE("BANCO","listadetarefas");
        DEFINE("USUARIO","root");
        DEFINE("SENHA","");
        $conexao = new PDO("mysql:host=".SERVIDOR.";dbname=".BANCO,USUARIO,SENHA);
        $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $erro){
        echo "<strong>ERRO de PDO = </strong>".$erro->getMessage();
    }
?>