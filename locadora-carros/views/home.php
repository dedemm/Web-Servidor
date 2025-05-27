<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: /login');
    exit();
}

$emailCompleto = $_SESSION['usuario'];
$usuarioExibido = explode('@', $emailCompleto)[0];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/stylesHome.css" media="screen" />
</head>
<body>
    <div class="home-container">
        <div class="welcome-card">
            <h1>Bem-vindo(a), <span><?= htmlspecialchars($usuarioExibido) ?></span>!</h1>
            <p>Aproveite os recursos da nossa locadora.</p>
        </div>

        <ul class="menu">
            <li><a href="/listar_reservas">Minhas reservas</a></li>
            <li><a href="/listar_carros">Carros</a></li>
            <?php 
                if ($_SESSION['funcao'] == 'admin') {
                    echo '<li><a href="/cadastrar_carro">Cadastrar Carro</a></li>';
                    echo '<li><a href="/gerenciar_usuarios">Gerenciar usuários</a></li>';
                }
            ?>
        </ul>

        <a class="logout-button" href="/logout">Sair</a>
    </div>
</body>
</html>
