<?php
// Inicia ou recupera a sessão do usuário.
session_start();

// Impede que o navegador armazene a página em cache.
// Ajuda a evitar a exibição de conteúdo antigo após o logout.
header('Cache-Control: no-store, no-cache, must-revalidate');

// Verifica se o usuário está autenticado.
// A variável de sessão 'usuario_id' deve ser definida no login.
if (!isset($_SESSION['usuario_id'])) {

    // Redireciona o usuário para a página de login.
    header('Location: login.php');

    // Encerra a execução do código após o redirecionamento.
    exit;
}

// Importa o arquivo responsável pela conexão com o MySQL.
// Esse arquivo deve disponibilizar a variável $conexao.
require 'conexao.php';

// Executa uma consulta SQL no banco de dados.
$resultado = mysqli_query(

    // Conexão com o banco de dados MySQL.
    // Seleciona os campos desejados da tabela contato.
    // ORDER BY organiza os registros pelo ID em ordem decrescente.
    // DESC faz com que os maiores IDs apareçam primeiro.
    $conexao,
    "SELECT id, nome, email, telefone, criado_em
     FROM clientes
     ORDER BY id DESC"
);

// Verifica se ocorreu algum erro na execução da consulta.
// mysqli_query retorna false quando a consulta falha.
if (!$resultado) {

    // Define o código HTTP 500, indicando erro interno no servidor.
    http_response_code(500);

    // Exibe uma mensagem de erro e encerra a execução.
    exit("Não foi possível carregar os contatos.");
}

// Função auxiliar para exibir informações com segurança no HTML.
// Recebe um valor e converte caracteres especiais em entidades HTML.
// Ajuda a prevenir ataques de Cross-Site Scripting (XSS)
// quando os dados são exibidos no conteúdo da página.
function h($valor)
{
    // Converte o valor recebido para texto (string).
    // ENT_QUOTES converte aspas simples e duplas.
    // ENT_SUBSTITUTE substitui sequências inválidas de caracteres.
    // UTF-8 define a codificação utilizada na conversão.
    return htmlspecialchars(
        (string)$valor,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

require("conexao.php");

if (isset($_POST['atualizar'])) {
    $idUsuario  = $_POST['idusuario'];
    $nome  = $_POST['nome'];
    $email           = $_POST['email'];
    $telefone          = $_POST['telefone'];

    $atualizar = "UPDATE usuario SET nome = '$nome', email = '$email' WHERE idUsuario = '$idUsuario'";

    if (mysqli_query($conexao, $atualizar)) {
        echo "
        <script>
            alert('Dados atualizado com sucesso');
            window.location='atualizarCurso.php';
        </script>";
        exit();
    } else {
        echo "Erro ai atualizar" . mysqli_error($conexao);
    }
}

$editaUsuario = null;

if (isset($_GET['editar'])) {

    $idEditar = $_GET['editar'];

    $resultado = mysqli_query(
        $conexao,
        "SELECT * FROM usuario WHERE idUsuario = $idEditar"
    );

    $editaUsuario = mysqli_fetch_assoc($resultado);
}

$usuarios = mysqli_query(
    $conexao,
    "SELECT * FROM usuario"
);


if (isset($_GET['apagar'])) {
    $idUsuario = $_GET['apagar'];

    $deletar = "DELETE FROM usuario WHERE idUsuario = $idUsuario";

    if (mysqli_query($conexao, $deletar)) {
        echo "
        <script>
            alert('Dado excluido com sucesso!');
            window.location='painel.php';
        </script>";
        exit();
    } else {
        echo "Erro ao deletar." . mysqli_error($conexao);
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | SweetRewind</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #ffffff;
            min-height: 100vh;
        }

        main {
            padding: 30px;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        .tabela-container {
            background-color: white;
            padding: 0;
            overflow-x: auto;
        }

        .tabela-usuarios {
            margin-bottom: 0;
            width: 100%;
        }

        .tabela-usuarios thead th {
            background-color: #e861b4;
            color: white;
            padding: 12px;
            border: 1px solid #f8f7f8;
        }

        .tabela-usuarios tbody td {
            padding: 10px;
            vertical-align: middle;
        }

        .tabela-usuarios tbody tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        .tabela-usuarios tbody tr:nth-child(even) {
            background-color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark" style="background-color: #C53771;">
        <div class="container"><span class="navbar-brand"> Sweet Rewind | Administração</span>
            <form action="logout.php" method="POST"><button class="btn btn-outline-light">Sair</button></form>
        </div>
    </nav>

    <main>
        <main>
            <section class="container-fluid">

                <h2>Lista de Cadastros da Confeitaria</h2>

                <div class="tabela-container">

                    <table class="table table-striped table-bordered tabela-usuarios">

                        <thead>
                            <tr>
                                <th>ID do Usuário</th>
                                <th>Nome do Cliente</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php while ($usuario = mysqli_fetch_assoc($usuarios)): ?>

                                <tr>
                                    <td><?= $usuario['idUsuario'] ?></td>

                                    <td><?= $usuario['nome'] ?></td>

                                    <td><?= $usuario['email'] ?></td>

                                    <td>
                                        <a href="?editar=<?= $usuario['idUsuario'] ?>"
                                            class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <a href="?apagar=<?= $usuario['idUsuario'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Deseja realmente apagar este usuário?')">
                                            Apagar
                                        </a>
                                    </td>
                                </tr>

                            <?php endwhile; ?>

                        </tbody>
                    </table>

                </div>

                <?php if ($editaUsuario): ?>

                    <!-- Mantenha aqui seu formulário de edição atual -->

                <?php endif; ?>

            </section>
        </main>
        <?php if ($editaUsuario): ?>
            <div class="container">
                <div class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">
                    <h3>Editar Usuario</h3>

                    <form method="POST">
                        <input type="hidden" name="idUsuario" value="<?= $editaUsuario['idUsuario'] ?>">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input value="<?= $editaUsuario['nome'] ?>" type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome">
                        </div>

                        <div class="mb-3">
                            <label for="curso" class="form-label">Email</label>
                            <input value="<?= $editaUsuario['email'] ?>" type="text" name="email" id="email" class="form-control" placeholder="Digite seu email">
                        </div>

                        <a href="painel.php"><button type="submit" name="atualizar" class="btn btn-warning">Atualizar</button></a>

                        <a href="painel.php"><button type="button" class="btn btn-dark">Cancelar</button></a>
                    </form>

                </div>

            <?php endif; ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>