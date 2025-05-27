<?php
require_once 'Conexao.php';

class CarroModel {
    private $conn;

    public $id;
    public $modelo;
    public $placa;
    public $ano;
    public $cor;
    public $disp;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    public function listarTodos() {
        $resultado = $this->conn->query("SELECT * FROM carros");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function existePlaca(string $placa): bool {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM carros WHERE placa = ?");
        $stmt->bind_param('s', $placa);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function cadastrar(): bool {
        $stmt = $this->conn->prepare("INSERT INTO carros (modelo, placa, ano, cor, disp) VALUES (?, ?, ?, ?, 'sim')");
        $stmt->bind_param('ssis', $this->modelo, $this->placa, $this->ano, $this->cor);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>
