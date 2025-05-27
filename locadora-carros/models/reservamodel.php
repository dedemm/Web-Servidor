<?php
require_once 'Conexao.php';

class ReservaModel {
    public $idUsuario;
    public $placa;
    public $data;

    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listarPorUsuario(int $idUsuario): array {
        $stmt = $this->conn->prepare("SELECT * FROM reservas WHERE id_usuario = ?");
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $reservas = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $reservas;
    }

    public function existeReserva(string $placa, string $data): bool {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM reservas WHERE placa = ? AND data = ?");
        $stmt->bind_param('ss', $placa, $data);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $row = $resultado->fetch_assoc();
        $stmt->close();
        return $row['total'] > 0;
    }

    public function cadastrar(): bool {
        $stmt = $this->conn->prepare("INSERT INTO reservas (id_usuario, placa, data) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $this->idUsuario, $this->placa, $this->data);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>
