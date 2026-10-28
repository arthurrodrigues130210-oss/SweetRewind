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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body style="background-color: #ffd7e6;">
    <main>
        <!-- Navbar -->
        <div class="collapse" id="navbarToggleExternalContent">

            <div class="p-4" style="background-color: #FFF1E6;">

                <h5 class="h4" style="color: #970202;">
                    Sweet Rewind
                </h5>

                <span style="color: #970202;">
                    Um pedacinho de nostalgia, uma fatia de felicidade 𖹭
                </span>


                <br><br>

                <div class="tab-content" id="v-pills-tabContent" style="color: #970202;">



                    <div class="d-flex align-items-start">


                        <div class="nav flex-column nav-pills me-3 align-items-start" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical" style="min-width: 200px;">

                            <a href="index.html">
                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Início
                            </button></a>
                            <br>

                            <a href="cadastro.php">
                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Perfil
                            </button></a>
                            <br>


                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Produtos
                            </button> <br>


                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Pedidos
                            </button> <br>

                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Sobre Nós
                            </button> <br>


                            <button class="nav-link active w-100 text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true" style="background-color: #970202; color: #FFF1E6;">
                                Configurações
                            </button> <br>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <nav class="navbar" style="background-color: #FFF1E6;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Abrir menu" style="border-color: #970202;">

                    <span class="navbar-toggler-icon"
                        style="filter: brightness(0) saturate(100%) invert(9%) sepia(98%) saturate(5094%) hue-rotate(4deg) brightness(83%) contrast(113%);">
                    </span>

                </button>
            </div>
        </nav>

        <!-- Cadastro do perfil -->
        
<section id="cadastro" class="py-5"
    style="background-color: #FFF0F3;">

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm border-0 p-4">

                    <h2 class="text-center fw-bold mb-3"
                        style="color: #970202;">
                        Cadastro de Cliente ♡
                    </h2>

                    <p class="text-center">
                        Faça parte do mundo Sweet Rewind!
                    </p>

                    <form action="cadastro.php" method="POST">

                        <div class="mb-3">
                            <label for="nome" class="form-label">
                                Nome completo
                            </label>

                            <input type="text"
                                class="form-control"
                                id="nome"
                                name="nome"
                                maxlength="150"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                E-mail
                            </label>

                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                maxlength="150"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">
                                Telefone
                            </label>

                            <input type="tel"
                                class="form-control"
                                id="telefone"
                                name="telefone"
                                maxlength="20"
                                placeholder="(00) 00000-0000"
                                required>
                        </div>

                        <button type="submit"
                            class="btn w-100 text-white"
                            style="background-color: #c66b91;">
                            Cadastrar ♡
                        </button>

                    </form>

                    <?php if (isset($_GET["sucesso"])): ?>
                        <div class="alert alert-success mt-3 mb-0">
                            Cadastro realizado com sucesso!
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET["erro"])): ?>
                        <div class="alert alert-danger mt-3 mb-0">
                            <?php
                            $erros = [
                                "1" => "Preencha todos os campos.",
                                "2" => "Digite um e-mail válido.",
                                "3" => "Erro ao salvar o cadastro."
                            ];

                            echo $erros[$_GET["erro"]]
                                ?? "Não foi possível realizar o cadastro.";
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>


<?php

require_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");

    if ($nome === "" || $email === "" || $telefone === "") {
        header("Location: index.php?erro=1#cadastro");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?erro=2#cadastro");
        exit;
    }

    $sql = "INSERT INTO cadastro (nome, email, telefone)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $nome,
        $email,
        $telefone
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);

        header("Location: index.php?sucesso=1#cadastro");
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    header("Location: index.php?erro=3#cadastro");
    exit;
}

header("Location: index.php#cadastro");
exit;
?>


    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>

</html>