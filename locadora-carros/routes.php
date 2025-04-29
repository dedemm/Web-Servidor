<?php

$rota = $_GET['rota'] ?? 'login';

switch ($rota) {
    case 'login':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->login();
        break;

    case 'listar_carros':
        require_once 'controllers/CarroController.php';
        $controller = new CarroController();
        $controller->listarCarros();
        break;

    case 'listar_reservas':
        require_once 'controllers/CarroController.php';
        $controller = new CarroController();
        $controller->listarReservas();
        break;

    case 'reservar':
         require_once 'controllers/CarroController.php';
         $controller = new CarroController();
         $controller->reservar();
         break;

    case 'logout':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->logout();
        break;

    case 'cadastrar':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->cadastrar();
        break;

    case 'cadastrar_carro':
        require_once 'controllers/CarroController.php';
        $controller = new CarroController();
        $controller->cadastrar_carro();
        break;
        
    default:
        echo "Rota não encontrada.";
        break;
}

?>