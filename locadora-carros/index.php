<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['usuario'])) {
    include 'views/login.php';
    exit();
}

include 'views/home.php';

?>