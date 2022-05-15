<?php
    if(isset($_GET["id"])){
        include_once("config/conexao.php");
        $id = $_GET["id"];
        $delete = "DELETE FROM tarefas WHERE id=:id";
        try{
            $resultado = $conexao -> prepare($delete);
            $resultado -> bindParam(":id",$id,PDO::PARAM_STR);
	        $resultado -> execute();
            header("Location: index.php");
        }
        catch(PDOException $erro){
            echo "<strong>ERRO de PDO = ".$erro->getMessage();
        }
    }
    else{
        header("Location: index.php");
    }
?>