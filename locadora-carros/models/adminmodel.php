<?php

require_once __DIR__ . '/Conexao.php';

class AdminModel {
    private $conn;

    public $id_usuario;
    public $email;
    public $funcao;

    public function __construct($conn = null) {
        $this->conn = $conn ?: Conexao::getConexao();
    }

    public function listarTodos() {
        $sql = "SELECT id_usuario, email, funcao FROM usuarios";
        $result = $this->conn->query($sql);

        if (!$result) {
            throw new Exception("Erro na consulta: " . $this->conn->error);
        }

        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        $result->free();

        return $usuarios;
    }

    public function buscarPorId($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro no prepare: " . $this->conn->error);
        }

        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $usuario = $result->fetch_assoc();
        $stmt->close();

        if ($usuario) {
            $this->id_usuario = $usuario['id_usuario'];
            $this->email = $usuario['email'];
            $this->funcao = $usuario['funcao'];
        }

        return $usuario;
    }

    public function atualizar() {
        if (!$this->id_usuario) {
            throw new Exception("ID do usuário não definido");
        }

        $sql = "UPDATE usuarios SET email = ?, funcao = ? WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro no prepare: " . $this->conn->error);
        }

        $stmt->bind_param('ssi', $this->email, $this->funcao, $this->id_usuario);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function excluir() {
        if (!$this->id_usuario) {
            throw new Exception("ID do usuário não definido");
        }

        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro no prepare: " . $this->conn->error);
        }

        $stmt->bind_param('i', $this->id_usuario);
        if (!$stmt->execute()) {
            $erro = $stmt->error;
            $codigo = $stmt->errno;
            $stmt->close();
        // Lança exceção se falhar (ex: por chave estrangeira)
            throw new Exception("Erro ao excluir usuário: $erro", $codigo);
        }
        
      
        $stmt->close();

        return true;
    }
}
