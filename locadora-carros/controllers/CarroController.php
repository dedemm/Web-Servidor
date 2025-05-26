<?php

require 'vendor/autoload.php';
require_once __DIR__ . '/../models/CarroModel.php';
require_once __DIR__ . '/../models/ReservaModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CarroController {

    public function listarCarros() {
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
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = $_POST['modelo'];
            $ano = $_POST['ano'];
            $cor = $_POST['cor'];
            $placa = $_POST['placa'];

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
}
?>
