<?php
    if(isset($_GET["id"])){
        include_once("config/conexao.php");
        $id = $_GET["id"];
        $select = "SELECT * FROM tarefas WHERE id=:id";
        try{
            $resultSel = $conexao -> prepare($select);
            $resultSel -> bindParam(":id",$id,PDO::PARAM_STR);
            $resultSel -> execute();
            $contar = $resultSel -> rowCount();
            if($contar > 0){
                while($objeto = $resultSel -> FETCH(PDO::FETCH_OBJ)){
                    if($objeto -> concluida == 0){
                        $update = "UPDATE tarefas SET concluida=true WHERE id=:id";
                        $resultUpt = $conexao -> prepare($update);
                        $resultUpt -> bindParam(":id",$id,PDO::PARAM_STR);
                        $resultUpt -> execute();
                    }
                    else{
                        $update = "UPDATE tarefas SET concluida=false WHERE id=:id";
                        $resultUpt = $conexao -> prepare($update);
                        $resultUpt -> bindParam(":id",$id,PDO::PARAM_STR);
                        $resultUpt -> execute();
                    }
                }
            }
            header("Location: index.php");
        }
        catch(PDOException $erro){
            echo "<strong>ERRO de PDO = </strong>".$erro -> getMessage();
        }
    }
    else{
        header("Location: index.php");
    }
?>