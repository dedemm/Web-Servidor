<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

?>

<h1>Cadastrar Carro</h1>
<link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />

<form method="POST" action="routes.php?rota=cadastrar_carro">
    <label>Modelo:</label><br>
    <input type="text" name="modelo" required><br><br>

    <label>Placa:</label><br>
    <input type="text" name="placa" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required><br><br>

    <label>Cor:</label><br>
    <input type="text" name="cor" required><br><br>

    <?php
        if (isset($_SESSION['mensagem'])) {
            $tipo = $_SESSION['mensagem']['tipo']; 
            $texto = $_SESSION['mensagem']['texto'];
        
            echo "<div class='mensagem'>$texto</div>";
        
            unset($_SESSION['mensagem']);
            
        } ?>

    <button type="submit">Salvar Carro</button>
</form>

<br>
<form action="index.php" method="get">
    <button type="submit">Voltar</button>
</form>
