<?php

require_once __DIR__ . '/../database/conexao.php';

function buscarReservas() {
    global $bd;
    $query = $bd->query("SELECT * FROM reservas");
    $reservas = [];

    while ($row = $query->fetch_object()) {
        $reservas[] = $row;
    }

    return $reservas;
}

function buscarReservaPorPlacaData($placa, $data) {
    global $bd;
    $stmt = $bd->prepare("SELECT * FROM reservas WHERE placa = ? AND data = ?");
    $stmt->bind_param("ss", $placa, $data);
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado->fetch_object();
}

function salvarReserva($id_usuario, $placa, $data) {
    global $bd;
    $stmt = $bd->prepare("INSERT INTO reservas (id_usuario, placa, data) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id_usuario, $placa, $data);
    return $stmt->execute();
}

function buscarReservasPorUsuario($id_usuario) {
    global $bd;
    $stmt = $bd->prepare("SELECT * FROM reservas WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservas = [];
    while ($reserva = $result->fetch_object()) {
        $reservas[] = $reserva;
    }

    return $reservas;
}

require_once __DIR__ . '/../database/conexao.php';

function buscarReservasComCarroPorUsuario($id_usuario) {
    global $bd;
    $sql = "
        SELECT r.placa, r.data, c.modelo, c.ano, c.cor
        FROM reservas r
        JOIN carros c ON r.placa = c.placa
        WHERE r.id_usuario = ?
    ";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservas = [];
    while ($reserva = $result->fetch_assoc()) {
        $reservas[] = $reserva;
    }
    return $reservas;
}



?>







