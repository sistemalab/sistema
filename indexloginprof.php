<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Página de Login</h1>
    </header>
    <div class="container" id="cont">
        <form action="indexloginprof.php" method="post">
        <table>
            <tr>
                <th>SIAPE</th>
            </tr>
            <tr>
                <td>
                    <div class="ajeitar">
                        <label for="siape"></label>
                        <input type="number" name="siape" id="siape" required>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Senha</th>
            </tr>
            <tr>
                <td>
                    <div class="ajeitar">
                        <label for="senha"></label>
                        <input type="password" name="senha" id="senha" required>
                    </div>
                </td>
            </tr>
        </table>
        <div class="login">
            <button id="botaologin" type="submit">Login</button>
        </div>
        </form>
    </div>
    <div class="container">
    <?php
    session_start(); // Inicie a sessão no início do arquivo
    include("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $siape = $_POST['siape'];
        $senha = $_POST['senha'];

        $sql = "SELECT nome FROM professor WHERE siape = ? AND senha = ?";
        $consulta = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($consulta, "is", $siape, $senha); 
        mysqli_stmt_execute($consulta);
        $result = mysqli_stmt_get_result($consulta);

        if (mysqli_num_rows($result) == 1) {
            // Login bem-sucedido
            $professor = mysqli_fetch_assoc($result);
            $_SESSION['nome_professor'] = $professor['nome']; 
            header("Location: logicatelaReservas1.php"); 
            exit();
        } else {
            echo "Erro: Usuário ou senha incorretos.";
        }

        mysqli_stmt_close($consulta);
        mysqli_close($conexao);
    }
    ?>
    </div>
</body>
</html>
