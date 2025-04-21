<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Locadora de Carros - Home</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>
    <p>Você está logado na Locadora de Carros.</p>

    <ul>
        <li><a href="">Minhas reservas</a></li>
        <li><a href="routes.php?rota=listar_carros">Carros</a></li>

    </ul>
    <p><a href="index.php?logout=1">Sair</a></p>
</body>
</html>
