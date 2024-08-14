<?php

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "sistemadereservalab";
    /*Esta função mysqli_connect cria uma conexão com o banco de dados de acordo com os parâmetros e armazena em uma variável*/
    $conexao=mysqli_connect($servidor,$usuario,$senha,$bd);
    if(!$conexao){
        die("houve um erro".mysqli_connect_error());
    }

?>