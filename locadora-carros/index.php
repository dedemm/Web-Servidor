<?php

require_once __DIR__ . '/models/Conexao.php';

require_once __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;

session_start();

Router::get('/', function () {
    if (!isset($_SESSION['usuario'])) {
        require 'views/login.php';
    } else {
        require 'views/home.php';
    }
    exit();
});

Router::get('/home', function () {
    require_once 'controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index(); 
});

Router::get('/login', function () {
    require_once 'controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->login(); 
});

Router::post('/login', function () {
    require_once 'controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->login(); 
});

Router::get('/logout', function () {
    session_destroy();
    header('Location: /');
    exit();
});

Router::get('/cadastrar', function () {
    require_once 'controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->cadastrar(); 
});

Router::post('/cadastrar', function () {
    require_once 'controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->cadastrar(); 
});

Router::get('/listar_carros', function () {
    require_once 'controllers/CarroController.php';
    $controller = new CarroController();
    $controller->listarCarros();
});

Router::get('/listar_reservas', function () {
    require_once 'controllers/CarroController.php';
    $controller = new CarroController();
    $controller->listarReservas();
});

Router::post('/reservar', function () {
    require_once 'controllers/CarroController.php';
    $controller = new CarroController();
    $controller->reservar();
});

Router::get('/cadastrar_carro', function () {
    require_once 'controllers/CarroController.php';
    $controller = new CarroController();
    $controller->cadastrar_carro();
});

Router::post('/cadastrar_carro', function () {
    require_once 'controllers/CarroController.php';
    $controller = new CarroController();
    $controller->cadastrar_carro();
});

Router::get('/gerenciar_usuarios', function () {
    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->listarUsuarios();
});

Router::get('/editar_usuario/{id}', function ($id) {
    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarUsuarioForm($id);
});

Router::post('/editar_usuario/{id}', function ($id) {
    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->editarUsuario($id);
});

Router::post('/excluir_usuario/{id}', function ($id) {
    require_once 'controllers/AdminController.php';
    $controller = new AdminController();
    $controller->excluirUsuario($id);
});


Router::get('/not-found', function () {
    echo '<h1>404 - Página não encontrada</h1>';
});

Router::error(function (Request $request, \Exception $exception) {
    if ($exception->getCode() === 404) {
        Router::response()->redirect('/not-found');;
    } else {
        echo "<h2>Erro: {$exception->getMessage()}</h2>";
    }
});

Router::start(true);



?>
