<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/carromodel.php';
require_once __DIR__ . '/../models/reservamodel.php';

class CarroController {

    public function listarCarros() {
        $carros = buscarTodosCarros();
        include(__DIR__ . '/../views/listarcarros.php');
    }

    public function minhasReservas() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php?rota=login');
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
    
    
    
    
}

?>