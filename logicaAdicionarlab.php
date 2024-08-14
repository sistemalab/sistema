<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Laboratório</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Adicionar Laboratório</h1>
    </header>
    <nav class="menu">
        <a href="addLab.html">Adicionar Laboratório</a>
        <a href="logicaRemoverlab.php">Remover Laboratório</a>
        <a href="logicaStatuslab.php">Status do Laboratório</a>
        <a href="addProf.html">Adicionar Professor</a>
        <a href="remProf.html">Remover Professor</a>
    </nav> 
    <div class="container">
    <form action="logicaAdicionarlab.php" method="post">
        <table>
            <tr>
                <th>Número do Laboratório:</th>
                <th>Número de Computadores:</th>
            </tr>
            <tr>
                <td>
                    <div class="lab">
                        <label for="numero_lab"></label>
                        <input type="number" id="numero_lab" name="numero_lab" required>
                    </div>
                </td>
                <td>
                    <div class="lab">
                        <label for="numero_comp"></label>
                        <input type="number" id="numero_comp" name="numero_comp" required>
                    </div>
                </td>
            </tr>
        </table>
        <div id="botaoLab">
            <button type="submit">Adicionar Laboratório</button>
            <a class="botaolink" href="telaadm.html">Voltar para tela principal</a>
        </div>
    </form>
    </div>
    

    <div class = "container">

    <?php 
    
    include("conexao.php");
    $numeroLaboratorio = $_POST['numero_lab'];
    $numeroComputadores = $_POST['numero_comp'];
    $sql=" INSERT INTO laboratorio(numero_laboratorio, numero_computadores)
            VALUES ('$numeroLaboratorio', '$numeroComputadores') ";
    echo ("Comando SQL - $sql");
    /*Esta função mysqli_query - realiza uma consulta em um banco de dados, ela precisa de dois parâmetros qual a conexão e qual a consulta*/
    if(mysqli_query($conexao,$sql)){
        echo ("Laboratório cadastrado com sucesso!");
    }
    else{
        echo("Erro.").mysqli_connect_error($conexao);
    }
    mysqli_close($conexao);
    ?> 

    </div>
      
</body>
</html>
