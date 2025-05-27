<?php

require 'vendor/autoload.php';
require_once __DIR__ . '/../models/CarroModel.php';
require_once __DIR__ . '/../models/ReservaModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CarroController
{
    private $carroModel;
    private $reservaModel;

    public function __construct() {
        $this->carroModel = new CarroModel();
        $this->reservaModel = new ReservaModel();
    }

    public function listarCarros()
    {
        $carros = $this->carroModel->listarTodos();
        include __DIR__ . '/../views/listarcarros.php';
    }

    public function listarReservas()
    {
        $idUsuario = $_SESSION['usuario_id'] ?? null;

        if (!$idUsuario) {
            header('Location: /login');
            exit();
        }

        $reservas = $this->reservaModel->listarPorUsuario($idUsuario);
        $carros = $this->carroModel->listarTodos();

        include __DIR__ . '/../views/listarreservas.php';
    }

    public function reservar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "<p>Requisição inválida.</p>";
            return;
        }

        $idUsuario = $_SESSION['usuario_id'] ?? null;
        $placa = $_POST['placa'] ?? '';
        $data = $_POST['data'] ?? '';

        if (!$idUsuario) {
            $_SESSION['mensagem'] = [
                'tipo' => 'erro',
                'texto' => 'Você precisa estar logado para reservar.'
            ];
            header('Location: /home');
            exit();
        }

        if ($this->reservaModel->existeReserva($placa, $data)) {
            $_SESSION['mensagem'] = [
                'tipo' => 'erro',
                'texto' => "Este carro já está reservado para o dia $data."
            ];
            header('Location: /listar_carros');
            exit();
        }

        $this->reservaModel->idUsuario = $idUsuario;
        $this->reservaModel->placa = $placa;
        $this->reservaModel->data = $data;

        $res = $this->reservaModel->cadastrar();

        if ($res) {
            $_SESSION['mensagem'] = [
                'tipo' => 'sucesso',
                'texto' => "Carro reservado com sucesso para o dia $data!"
            ];
        } else {
            $_SESSION['mensagem'] = [
                'tipo' => 'erro',
                'texto' => 'Erro ao reservar o carro. Tente novamente.'
            ];
        }

        header('Location: /listar_carros');
        exit();
    }

    public function cadastrar_carro()
    {
        if (($_SESSION['funcao'] ?? '') !== 'admin') {
            $_SESSION['mensagem'] = [
                'tipo' => 'erro',
                'texto' => 'Acesso negado. Apenas administradores podem cadastrar carros.'
            ];
            header('Location: /home');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = $_POST['modelo'] ?? '';
            $ano = (int)($_POST['ano'] ?? 0);
            $cor = $_POST['cor'] ?? '';
            $placa = $_POST['placa'] ?? '';

            if ($this->carroModel->existePlaca($placa)) {
                $_SESSION['mensagem'] = [
                    'tipo' => 'erro',
                    'texto' => 'Já existe um carro com essa placa cadastrada.'
                ];
                header('Location: /cadastrar_carro');
                exit();
            }

            $this->carroModel->modelo = $modelo;
            $this->carroModel->placa = $placa;
            $this->carroModel->ano = $ano;
            $this->carroModel->cor = $cor;

            $res = $this->carroModel->cadastrar();

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
            include __DIR__ . '/../views/cadastrocarros.php';
        }
    }
}
