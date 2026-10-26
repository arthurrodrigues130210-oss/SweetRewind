<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_POST['aluno'];
    $curso = $_POST['curso'];

    require("conexao.php");

    $inserir = "INSERT INTO matricula (nome,curso) VALUES ('$nome','$curso')";

    if (mysqli_query($conexao, $inserir)) {

        echo "
        <script>

        alert('Cadastro Realizado com sucesso!');
        window.location.href = 'cadastro.php';
        
        </script>";
        exit();
    } else {
        echo "
        <script>

        alert('Erro ao cadastrar:" . mysqli_error($conexao) . "';
        window.history.back();
        
        </script>";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
</head>

<body>
    <h2>Cadastro de Curso</h2>

    <form method="post" action="">
        <label>Nome: </label>
        <input type="text" name="aluno"> <br>

        <label>Curso: </label>
        <input type="text" name="curso"> <br>

        <button type="reset">Limpar</button>
        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>