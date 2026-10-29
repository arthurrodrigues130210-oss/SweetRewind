
<?php
require_once 'proteger_admin.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel | Sweet Rewind</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h1>Sweet Rewind</h1>
    <h2>Painel Administrativo</h2>

    <p>
        Bem-vindo,
        <?= htmlspecialchars($_SESSION['nome']) ?>!
    </p>

    <h3>Gerenciamento da confeitaria</h3>

    <ul>
        <li><a href="produtos_admin.php">Produtos</a></li>
        <li><a href="clientes_admin.php">Clientes</a></li>
        <li><a href="encomendas_admin.php">Encomendas</a></li>
    </ul>

    <a href="logout_admin.php">Sair do painel</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>
</html>
