<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status do Laboratório</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <h1>Status do Laboratório</h1>
    </header>
    <nav class="menu">
        <a href="addLab.html">Adicionar Laboratório</a>
        <a href="logicaRemoverlab.php">Remover Laboratório</a>
        <a href="logicaStatuslab.php">Status do Laboratório</a>
        <a href="addProf.html">Adicionar Professor</a>
        <a href="remProf.html">Remover Professor</a>
    </nav>
    <div class="container">
        <form action="logicaStatuslab.php" method="POST">
            <table class="tabelaRemover">
                <tr>
                    <th>Laboratório</th>
                    <th>Disponível</th>
                    <th>Manutenção</th>
                </tr>

                <?php
                include("conexao.php");
                $sqlresult = "SELECT numero_laboratorio, disponivel, manuntencao FROM laboratorio";
                $query = mysqli_query($conexao, $sqlresult);
                if ($query) {
                    while ($retorno = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td><label for='disponivel-" . $retorno['numero_laboratorio'] . "'>Laboratório " . $retorno['numero_laboratorio'] . "</label></td>";
                        echo "<td>";
                        if ($retorno['disponivel']) {
                            echo "<input type='checkbox' name='disponivel[]' value='" . $retorno['numero_laboratorio'] . "' id='disponivel-" . $retorno['numero_laboratorio'] . "' checked>";
                        } else {
                            echo "<input type='checkbox' name='disponivel[]' value='" . $retorno['numero_laboratorio'] . "' id='disponivel-" . $retorno['numero_laboratorio'] . "'>";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($retorno['manuntencao']) {
                            echo "<input type='checkbox' name='manutencao[]' value='" . $retorno['numero_laboratorio'] . "' id='manutencao-" . $retorno['numero_laboratorio'] . "' checked>";
                        } else {
                            echo "<input type='checkbox' name='manutencao[]' value='" . $retorno['numero_laboratorio'] . "' id='manutencao-" . $retorno['numero_laboratorio'] . "'>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <div id="botaoStatus">
                <button type="submit" name = "confirmar">Confirmar</button>
                <a class="botaolink" href="telaadm.html">Voltar para tela principal</a>
            </div>
        </form>
    </div>
    <div>
    <?php
if(isset($_POST['confirmar'])){
    include("conexao.php");
    $conflito = false;

    if (isset($_POST['disponivel']) && isset($_POST['manutencao'])) {
        foreach ($_POST['disponivel'] as $labDisp) {
            if (in_array($labDisp, $_POST['manutencao'])) {
                echo ("Erro: O laboratório $labDisp não pode ser marcado como disponível e em manutenção ao mesmo tempo.<br>");
                $conflito = true;
            }
        }
    }

    if (!$conflito) {
        $sqlinicio = "UPDATE laboratorio SET disponivel = FALSE, manuntencao = FALSE";
        mysqli_query($conexao, $sqlinicio);

        if (isset($_POST['disponivel'])) {
            foreach ($_POST['disponivel'] as $labDisp) {
                $sql = $conexao->prepare("UPDATE laboratorio SET disponivel = TRUE WHERE numero_laboratorio = ?");
                $sql->bind_param("i", $labDisp);
                if ($sql->execute()) {
                    echo ("Disponibilidade atualizada com sucesso para o laboratório $labDisp!<br>");
                } else {
                    echo ("Erro ao atualizar o laboratório $labDisp: " . $sql->error . "<br>");
                }
                $sql->close();
            }
        } else {
            echo ("Nenhum laboratório foi selecionado para disponibilidade.<br>");
        }

        if (isset($_POST['manutencao'])) {
            foreach ($_POST['manutencao'] as $labManut) {
                $sql = $conexao->prepare("UPDATE laboratorio SET manuntencao = TRUE WHERE numero_laboratorio = ?");
                $sql->bind_param("i", $labManut);
                if ($sql->execute()) {
                    echo ("Manutenção atualizada com sucesso para o laboratório $labManut!<br>");
                } else {
                    echo ("Erro ao atualizar o laboratório $labManut: " . $sql->error . "<br>");
                }
                $sql->close();
            }
        } else {
            echo ("Nenhum laboratório foi selecionado para manutenção.<br>");
        }
    }
        

    $_POST['confirmar'] = FALSE;
    $conexao->close();
    header("Location: logicaStatuslab.php");
}
?>

    </div>
</body>
</html>
