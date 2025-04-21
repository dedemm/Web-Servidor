<?php
session_start();

// Verifica se o usuário clicou em "logout"
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// Se o usuário não estiver logado, envia para o login
if (!isset($_SESSION['usuario'])) {
    include 'views/login.php';
    exit();
}

// Se estiver logado, redireciona para a home
include 'views/home.php';
