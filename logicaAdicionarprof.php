<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Professor</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Adicionar Professor</h1>
    </header>
    <nav class="menu">
        <a href="addLab.html">Adicionar Laboratório</a>
        <a href="logicaRemoverlab.php">Remover Laboratório</a>
        <a href="logicaStatuslab.php">Status do Laboratório</a>
        <a href="addProf.html">Adicionar Professor</a>
        <a href="remProf.html">Remover Professor</a>
    </nav> 
    <div class="container">
        <form action="logicaAdicionarprof.php" method="post">
        <table>
            <tr>
                <th>Nome:</th>
                <th>SIAPE</th>
                <th>E-mail</th>
                <th>Senha</th>
            </tr>
            <tr>
                <td>
                    <div class="lab">
                        <label for="nome_prof"></label>
                        <input type="text" id="nome_prof" name="nome_prof" required>
                    </div>
                </td>
                <td>
                    <div class="lab">
                        <label for="SIAPE"></label>
                        <input type="number" id="SIAPE" name="SIAPE" required>
                    </div>
                </td>
                <td>
                    <div class="lab">
                        <label for="E-mail"></label>
                        <input type="text" id="E-mail" name="E-mail" required>
                    </div>
                </td>
                <td>
                    <div class="lab">
                        <label for="Senha"></label>
                        <input type="password" id="Senha" name="Senha" required>
                    </div>
                </td>
            </tr>
        </table>
        <div id="addProf">
            <button type="submit">Adicionar Professor</button>
            <a class="botaolink" href="telaadm.html">Voltar para tela principal</a>
        </div>
    </form>
    </div>

    <div class = "container">
        <?php 
        include("conexao.php");
        $nomeprof = $_POST['nome_prof'];
        $siape = $_POST['SIAPE'];
        $email = $_POST['E-mail'];
        $senha = $_POST['Senha'];
        $sql=" INSERT INTO professor(nome, siape, email, senha)
                VALUES ('$nomeprof', '$siape', '$email', '$senha') ";
        if(mysqli_query($conexao,$sql)){
            echo ("Professor cadastrado com sucesso!");
        }
        else{
            echo("erro").mysqli_connect_error($conexao);
        }
        mysqli_close($conexao);
        
        ?>
    </div>

</body>
</html>
