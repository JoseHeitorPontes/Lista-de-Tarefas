<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body>
    <div class="container">
        <div class="app">
            <div class="topo">
                <form action="" method="post">
                    <input type="text" name="conteudo-tarefa" placeholder="Digite o conteúdo da tarefa..." required>
                    <button type="submit" name="botao">Criar</button>
                </form>
                <?php
                    include_once("config/conexao.php");
                    if(isset($_POST['botao'])){
                        $conteudo = $_POST['conteudo-tarefa'];
                        
                            $insert = "INSERT INTO tarefas(conteudo, concluida) VALUES(:conteudo, false)";
                            try{
                                $resultado = $conexao -> prepare($insert);
                                $resultado -> bindParam(":conteudo",$conteudo,PDO::PARAM_STR);
                                $resultado -> execute();
                            }
                            catch(PDOException $erro){
                                echo "<strong>ERRO de PDO = </strong>".$erro->getMessage();
                            }
                        
                    }
                ?>
            </div>
            <div class="tarefas">
                <ul>
                    <?php
                        $select = "SELECT * FROM tarefas ORDER BY id";
                        try{
                            $resultado = $conexao -> prepare($select);
                            $resultado -> execute();
                            $contar = $resultado -> rowCount();
                            if($contar > 0){
                                while($exibir = $resultado -> FETCH(PDO::FETCH_OBJ)){
                    ?>
                    <li>
                        <a href="pages/concluir.php?id=<?php echo $exibir -> id;?>" class="green">
                            <i class="fa-solid fa-check"></i>
                        </a>
                        <?php 
                            $concluida = $exibir -> concluida;
                            if($concluida == 1){
                                echo '<p class="concluida">'.$exibir -> conteudo.'</p>';
                            }
                            else{
                                echo '<p class="">'.$exibir -> conteudo.'</p>';
                            }
                        ?>
                        <a href="pages/deletar.php?id=<?php echo $exibir -> id;?>" class="red">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </li>
                    <?php
                                }
                            }
                        }
                        catch(PDOException $erro){
                            echo "<strong>ERRO de PDO = </strong>".$erro->getMessage();
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>