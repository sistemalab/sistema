<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Professor</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Remover Professor</h1>
    </header>
    <nav class="menu">
        <a href="addLab.html">Adicionar Laboratório</a>
        <a href="logicaRemoverlab.php">Remover Laboratório</a>
        <a href="logicaStatuslab.php">Status do Laboratório</a>
        <a href="addProf.html">Adicionar Professor</a>
        <a href="remProf.html">Remover Professor</a>
    </nav> 
    <div class="container">
        <form action="logicaRemoverprof.php" method="post">
        <table>
            <tr>
                <th>Nome:</th>
                <th>SIAPE:</th>
            </tr>
            <tr>
                <td>
                    <div class="lab">
                        <label for="nomeRprof"></label>
                        <input type="text" id="nomeRprof" name="nomeRprof" required>
                    </div>
                </td>
                <td>
                    <div class="lab">
                        <label for="SIAPE"></label>
                        <input type="number" id="SIAPE" name="SIAPE" required>
                    </div>
                </td>
            </tr>
        </table>
        <div id="botaoRemprof">
            <button type="submit">Remover Professor</button>
            <a class="botaolink" href="telaadm.html">Voltar para tela principal</a>
        </div>
    </form>
    </div>

    <div class = "container">
       <?php 
        include("conexao.php");
        $nomerprof = $_POST['nomeRprof'];
        $Siape = $_POST['SIAPE'];

        echo ("O professor $nomerprof foi removido com sucesso!");
       
        $sql_delete = "DELETE FROM professor WHERE siape = '$Siape'";

        echo("$sql_delete");
        if(mysqli_query($conexao, $sql_delete)){
            echo "Professor removido com sucesso!";
         } 
        else{
            echo "Erro ao inserir laboratórios."
                   ;
             }
           mysqli_close($conexao);
        ?> 
    </div>
    

</body>
</html>
