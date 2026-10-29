<?php
session_start();
require_once 'conexao.php';

$aviso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT id, perfil, email, senha_hash
            FROM usuario
            WHERE email = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_assoc($resultado);

    if (
        $dados &&
        $dados['perfil'] === 'desenvolvedor' &&
        !empty($dados['senha_hash']) &&
        password_verify($senha, $dados['senha_hash'])
    ) {
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $dados['id'];
        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['perfil'] = $dados['perfil'];

        header('Location: painel_admin.php');
        exit;
    }

    $aviso = 'E-mail ou senha inválidos, ou acesso não autorizado.';
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo | Sweet Rewind</title>
</head>

<body>
    <h1>Sweet Rewind</h1>
    <h2>Acesso dos desenvolvedores</h2>

    <?php if ($aviso !== ''): ?>
        <p><?= htmlspecialchars($aviso) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <br><br>

        <button type="submit">Entrar</button>
    </form>
</body>

</html>