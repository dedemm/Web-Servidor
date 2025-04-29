<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: /login');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />
</head>
<body>
    <h1>Bem-vindo a nossa Locadora de Carros, <?php echo $_SESSION['usuario']; ?>!</h1>

    <ul>
        <li><a href="/listar_reservas">Minhas reservas</a></li>
        <li><a href="/listar_carros">Carros</a></li>
        <li><a href="/cadastrar_carro">Cadastrar Carro</a></li>

        <?php
        if (isset($_SESSION['mensagem'])) {
            $tipo = $_SESSION['mensagem']['tipo']; 
            $texto = $_SESSION['mensagem']['texto'];
        
            echo "<div class='mensagem'>$texto</div>";
        
            unset($_SESSION['mensagem']);
        } ?>

    </ul>
    <p></p>
    <p><a href="/logout">Sair</a></p>
</body>
</html>
