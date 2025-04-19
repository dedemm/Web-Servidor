<?php

$rota = $_GET['rota'] ?? 'login';

switch ($rota) {
    case 'login':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->login();
        break;
    
    case 'logout':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->logout();
        break;

    default:
        echo "Rota não encontrada.";
        break;
}
    