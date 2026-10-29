
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    !isset($_SESSION['nome_id']) ||
    ($_SESSION['perfil'] ?? '') !== 'desenvolvedor'
) {
    header('Location: login_admin.php');
    exit;
}
?>
