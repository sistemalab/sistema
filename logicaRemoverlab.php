<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Laboratório</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Remover Laboratório</h1>
    </header>
    <nav class="menu">
        <a href="addLab.html">Adicionar Laboratório</a>
        <a href="logicaRemoverlab.php">Remover Laboratório</a>
        <a href="logicaStatuslab.php">Status do Laboratório</a>
        <a href="addProf.html">Adicionar Professor</a>
        <a href="remProf.html">Remover Professor</a>
    </nav>
    
    <div class="container">
        <form action="logicaRemoverlab.php" method="post">
            <table class="tabelaRemover">
                <tr>
                    <th>
                        <label>Selecionar Laboratório:</label>
                    </th>
                </tr>
                <?php
                    include("conexao.php");
                 // consulta para fazer a dinamica entre as tela pra fixar como nao fixo
                    $sqlresult = "SELECT numero_laboratorio FROM laboratorio";
                    $query = mysqli_query($conexao,$sqlresult);
                    echo("<tr>");
                    while($retorno = @mysqli_fetch_array($query)){
                            echo "<tr>";
                            echo "<td>";
                            echo "<label for='lab-" . $retorno['numero_laboratorio'] . "'>Laboratório " . $retorno['numero_laboratorio'] . "</label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type='checkbox' name='check[]' value='" . $retorno['numero_laboratorio'] . "' id='lab-" . $retorno['numero_laboratorio'] . "'>";
                            echo "</td>";
                            echo "</tr>";
                     };
                ?>
            </table>
            <div id="botaoRem">
                <button type="submit">Remover Laboratório</button>
                <a class="botaolink" href="telaadm.html">Voltar para tela principal</a>
            </div>
        
    </div>
    </form>

    <div class="container">
    <?php
        include("conexao.php");
        if(isset($_POST['check'])) {
            $consulta = $conexao->prepare("DELETE FROM laboratorio WHERE numero_laboratorio = ?");
            if ($consulta === false) {
                echo "Erro ao preparar a declaração: " . $conexao->error;
            } else {
                foreach($_POST['check'] as $checkbox) {
                    $consulta->bind_param("i", $checkbox);
                    if($consulta->execute()) {
                        echo("Laboratório removido com sucesso!<br>");
                    } else {
                        echo("Erro ao remover o laboratório!" . $consulta->error . "<br>");
                    }
                }
                $consulta->close();
            }
        } else {
            echo("Nenhum laboratório foi selecionado.");
        }
        $conexao->close();
        ?>
    </div>
</body>
</html>
