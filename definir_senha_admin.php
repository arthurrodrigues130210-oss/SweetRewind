
<?php
require_once 'conexao.php';

$aviso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';

    if (strlen($senha) < 12) {
        $aviso = 'Use uma senha com pelo menos 12 caracteres.';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $email = 'email@email.com';

        $sql = "UPDATE nome
                SET senha_hash = ?
                WHERE email = ?
                AND perfil = 'desenvolvedor'";

        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $hash, $email);
        mysqli_stmt_execute($stmt);

        $aviso = mysqli_stmt_affected_rows($stmt) >= 0
            ? 'Operação concluída. Exclua este arquivo.'
            : 'Não foi possível atualizar a senha.';

        mysqli_stmt_close($stmt);
    }
}
?>

<form method="POST">
    <label for="senha">Nova senha do administrador:</label>
    <input type="password" id="senha" name="senha"
           minlength="12" required>
    <button type="submit">Definir senha</button>
</form>

<p><?= htmlspecialchars($aviso) ?></p>
