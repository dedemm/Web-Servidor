<?php
require_once 'Conexao.php';

class ReservaModel {
    public static function listarPorUsuario($idUsuario) {
        $bd = Conexao::getConexao();
        $stmt = $bd->prepare("SELECT * FROM reservas WHERE id_usuario = ?");
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $reservas = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $reservas;
    }

    public static function existeReserva($placa, $data) {
        $bd = Conexao::getConexao();
        $stmt = $bd->prepare("SELECT COUNT(*) AS total FROM reservas WHERE placa = ? AND data = ?");
        $stmt->bind_param('ss', $placa, $data);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }

    public static function cadastrar($idUsuario, $placa, $data) {
        $bd = Conexao::getConexao();
        $stmt = $bd->prepare("INSERT INTO reservas (id_usuario, placa, data) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $idUsuario, $placa, $data);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>
