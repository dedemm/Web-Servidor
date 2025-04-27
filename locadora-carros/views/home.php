<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />
</head>
<body>
    <h1>Bem-vindo a nossa Locadora de Carros, <?php echo $_SESSION['usuario']; ?>!</h1>

    <ul>
        <li><a href="routes.php?rota=listar_reservas">Minhas reservas</a></li>
        <li><a href="routes.php?rota=listar_carros">Carros</a></li>
        <li><a href="routes.php?rota=cadastrar_carro">Cadastrar Carro</a></li>

    </ul>
    <p><a href="index.php?logout=1">Sair</a></p>
</body>
</html>
