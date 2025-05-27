<?php
require_once 'Conexao.php';

class UsuarioModel {
    public $id;
    public $email;
    public $senha;
    public $funcao;

    private $bd;

    public function __construct() {
        $this->bd = Conexao::getConexao();
        if (!$this->bd) {
            die('Erro: Conexão com o banco de dados não foi estabelecida.');
        }
    }

    public function buscarPorEmail($email) {
        $stmt = $this->bd->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();
        $stmt->close();

        if ($usuario) {
            $this->id = $usuario['id_usuario'];
            $this->email = $usuario['email'];
            $this->senha = $usuario['senha'];
            $this->funcao = $usuario['funcao'];
            return $this;
        }
        return null;
    }

    public function cadastrar() {
        $stmt = $this->bd->prepare("INSERT INTO usuarios (email, senha, funcao) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $this->email, $this->senha, $this->funcao);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>
