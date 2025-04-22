<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CarroController {

    public function listarCarros() {
        $carros = include_once(__DIR__ . '/../data/carros.php');
        include(__DIR__ . '/../views/listarcarros.php');
    }
    
    public function reservar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $placa = $_POST['placa'];
            $data = $_POST['data'];
    

            $_SESSION['reservas'][] = [
                'usuario' => $_SESSION['usuario'],
                'placa' => $placa,
                'data' => $data
            ];
    
            echo "<p>Carro com placa <strong>$placa</strong> reservado para o dia <strong>$data</strong>!</p>";
            echo "<a href='routes.php?rota=listar_carros'>Voltar à lista de carros</a>";

        } else {
            echo "<p>Requisição inválida.</p>";
        }
    }
    
}

?>