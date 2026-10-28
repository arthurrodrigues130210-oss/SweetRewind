<?php
require_once "conexao.php";

$mensagem = "";
$tipoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (
        $nome === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($senha) < 8
    ) {
        $mensagem = "Preencha os campos corretamente. A senha deve ter pelo menos 8 caracteres.";
        $tipoMensagem = "erro";
    } else {
        $senhaHash = password_hash(
            $senha,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO clientes
                (nome, email, telefone, senha)
                VALUES (?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "ssss",
            $nome,
            $email,
            $telefone,
            $senhaHash
        );

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
            $tipoMensagem = "sucesso";
        } elseif ($stmt->errno === 1062) {
            $mensagem = "Este e-mail já está cadastrado.";
            $tipoMensagem = "erro";
        } else {
            $mensagem = "Não foi possível realizar o cadastro.";
            $tipoMensagem = "erro";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Sweet Rewind</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff5f7;
            color: #49323b;
        }

        .container {
            max-width: 420px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px #00000012;
        }

        h1 {
            text-align: center;
            color: #b45b7a;
        }

        p {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #e3c6d0;
            border-radius: 8px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #b45b7a;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #94435f;
        }

        .sucesso {
            color: #237544;
            text-align: center;
        }

        .erro {
            color: #b42318;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sweet Rewind</h1>
        <p>Crie sua conta e faça parte da nossa confeitaria!</p>

        <?php if ($mensagem !== ""): ?>
            <p class="<?= htmlspecialchars($tipoMensagem) ?>">
                <?= htmlspecialchars($mensagem) ?>
            </p>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">
            <label for="nome">Nome completo</label>
            <input
                type="text"
                id="nome"
                name="nome"
                maxlength="100"
                autocomplete="name"
                required>

            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                maxlength="150"
                autocomplete="email"
                required>

            <label for="telefone">Telefone</label>
            <input
                type="tel"
                id="telefone"
                name="telefone"
                maxlength="20"
                autocomplete="tel">

            <label for="senha">Senha</label>
            <input
                type="password"
                id="senha"
                name="senha"
                minlength="8"
                autocomplete="new-password"
                required>

            <button type="submit">
                Cadastrar
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>

</html>