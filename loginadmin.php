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
        <form action="loginadmin.php" method="post">
        <table>
            <tr>
                <th>Usuário</th>
            </tr>
            <tr>
                <td>
                    <div>
                        <label for="usuario"></label>
                        <input type="text" name="usuario" id="usuario">
                    </div>
                </td>
            </tr>
            <tr>
                <th>Senha</th>
            </tr>
            <tr>
                <td>
                    <div>
                        <label for="senha"></label>
                        <input type="password" name="senha" id="senha">
                    </div>
                </td>
            </tr>
        </table>
        <div class="login">
            <button id="botaologin">Login</button>
        </div>
    </form>
    </div>
    <div class=container>
    <?php
        include("conexao.php");

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM adm WHERE Usuario = ? AND Senha = ?";
        $consulta = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($consulta, "ss", $usuario, $senha);

        mysqli_stmt_execute($consulta);
        $resultado = mysqli_stmt_get_result($consulta);

        if (mysqli_num_rows($resultado) == 1) {
            echo "Login feito com sucesso!";
            header("Location: telaadm.html");
            exit();
        } else {
            echo "Erro: Usuário ou senha incorretos.";
        }

        mysqli_stmt_close($consulta);
        mysqli_close($conexao);
        ?>
    </div>
</body>
</html>
