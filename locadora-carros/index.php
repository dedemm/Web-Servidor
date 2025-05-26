<?php
<<<<<<< Updated upstream
=======

require_once __DIR__ . '/models/Conexao.php';

require_once __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;

>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
?>
=======
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

Router::error(function (Request $request, \Exception $exception) {
    if ($exception->getCode() === 404) {
        Router::response()->redirect('/not-found');;
    } else {
        echo "<h2>Erro: {$exception->getMessage()}</h2>";
    }
});

Router::start(true);

echo "Router finalizado";

?>
>>>>>>> Stashed changes
