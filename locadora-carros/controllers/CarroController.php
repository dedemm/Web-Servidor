<?php

<<<<<<< Updated upstream
=======
require 'vendor/autoload.php';
require_once __DIR__ . '/../models/CarroModel.php';
require_once __DIR__ . '/../models/ReservaModel.php';

>>>>>>> Stashed changes
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/carromodel.php';
require_once __DIR__ . '/../models/reservamodel.php';

class CarroController {

    public function listarCarros() {
<<<<<<< Updated upstream
        $carros = buscarTodosCarros();
        include(__DIR__ . '/../views/listarcarros.php');
    }

    public function minhasReservas() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?rota=login');
=======
        $carros = CarroModel::listarTodos();
        include(__DIR__ . '/../views/listarcarros.php');
    }

   public function listarReservas() {
    $idUsuario = $_SESSION['usuario_id'] ?? null;
    if (!$idUsuario) {
        header('Location: /login');
        exit();
    }

    $reservas = ReservaModel::listarPorUsuario($idUsuario);
    $carros = CarroModel::listarTodos();

    include(__DIR__ . '/../views/listarreservas.php');
}


public function reservar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $placa = $_POST['placa'];
        $data = $_POST['data'];
        $idUsuario = $_SESSION['usuario_id'] ?? null;
        if (!$idUsuario) {
            echo "<script>alert('Você precisa estar logado para reservar.'); window.location.href='/login';</script>";
            return;
        }

        if (ReservaModel::existeReserva($placa, $data)) {
            echo "<script>alert('Este carro já está reservado para o dia $data.'); window.location.href='/listar_carros';</script>";
            return;
        }

        $res = ReservaModel::cadastrar($idUsuario, $placa, $data);
        if ($res) {
            echo "<script>alert('Carro reservado com sucesso para o dia $data!'); window.location.href='/listar_carros';</script>";
        } else {
            echo "<script>alert('Erro ao reservar o carro. Tente novamente.'); window.location.href='/listar_carros';</script>";
        }
    } else {
        echo "<p>Requisição inválida.</p>";
    }
}

    public function cadastrar_carro() {
        if (($_SESSION['funcao'] ?? '') !== 'admin') {
            $_SESSION['mensagem'] = [
                'tipo' => 'erro',
                'texto' => 'Acesso negado. Apenas administradores podem cadastrar carros.'
            ];
            header('Location: /home'); 
>>>>>>> Stashed changes
            exit();
        }

        $id_usuario = $_SESSION['id_usuario'];
        $reservas = buscarReservasComCarroPorUsuario($id_usuario);
        include(__DIR__ . '/../views/listarreservas.php');
    }



    public function reservar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $placa = $_POST['placa'];
        $data = $_POST['data'];
        $email = $_SESSION['usuario'];

        // Carregar model de usuário para buscar id
        require_once __DIR__ . '/../models/usuariomodel.php';
        $usuario = buscarUsuarioPorEmail($email);

        if (!$usuario) {
            echo "<script>
                alert('Usuário não encontrado.');
                window.location.href='index.php?rota=listar_carros';
            </script>";
            return;
        }

        $id_usuario = $usuario['id_usuario'];


        // Verifica se já existe reserva para a placa e data
        $reservaExistente = buscarReservaPorPlacaData($placa, $data);

        if ($reservaExistente) {
            echo "<script>
                alert('Este carro já está reservado para o dia $data.');
                window.location.href='index.php?rota=listar_carros';
            </script>";
            return;
        }

        // Salva reserva com o id_usuario correto
        if (salvarReserva($id_usuario, $placa, $data)) {
            echo "<script>
                alert('Carro reservado com sucesso para o dia $data!');
                window.location.href='index.php?rota=listar_carros';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao reservar o carro. Tente novamente.');
                window.location.href='index.php?rota=listar_carros';
            </script>";
        }
    } else {
        echo "<p>Requisição inválida.</p>";
    }
}



    public function cadastrar_carro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = $_POST['modelo'];
            $ano = $_POST['ano'];
            $cor = $_POST['cor'];
            $placa = $_POST['placa'];
<<<<<<< Updated upstream
    
            $carroexiste = buscarCarroPorPlaca($placa);
    
            if ($carroexiste) {
                    $_SESSION['mensagem'] = [
                        'tipo' => 'erro',
                        'texto' => 'Já existe um carro com essa placa cadastrado .'
                    ];
               header('Location: index.php?rota=cadastrar_carro');

                    exit();
                
            }
    
            salvarCarro($modelo, (int)$ano, $cor, $placa);

        header('Location: routes.php?rota=listar_carros');
        exit();
    } else {
        include(__DIR__ . '/../views/cadastrocarros.php');
    }
}
    
    
    
    
=======

            if (CarroModel::existePlaca($placa)) {
                $_SESSION['mensagem'] = [
                    'tipo' => 'erro',
                    'texto' => 'Já existe um carro com essa placa cadastrada.'
                ];
                header('Location: /cadastrar_carro');
                exit();
            }

            $res = CarroModel::cadastrar($modelo, $placa, (int)$ano, $cor);
            if ($res) {
                header('Location: /listar_carros');
                exit();
            } else {
                $_SESSION['mensagem'] = [
                    'tipo' => 'erro',
                    'texto' => 'Erro ao cadastrar o carro. Tente novamente.'
                ];
                header('Location: /cadastrar_carro');
                exit();
            }
        } else {
            include(__DIR__ . '/../views/cadastrocarros.php');
        }
    }
>>>>>>> Stashed changes
}
?>
