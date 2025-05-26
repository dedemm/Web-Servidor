<?php
<<<<<<< Updated upstream

require_once __DIR__ . '/../database/conexao.php';

function buscarTodosUsuarios() {
    global $bd;
    $resultado = $bd->query("SELECT * FROM usuarios");
    $usuarios = [];

    while ($row = $resultado->fetch_assoc()) {
        $usuarios[$row['email']] = [
            'senha' => $row['senha'],
            'funcao' => $row['funcao']
        ];
    }

    return $usuarios;
}

function buscarUsuarioPorEmail($email) {
    global $bd;
    $stmt = $bd->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc(); // array associativo para facilitar
}



function salvarUsuario($email, $senha, $funcao) {
    global $bd;
    $stmt = $bd->prepare("INSERT INTO usuarios (email, senha, funcao) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $senha, $funcao);
    return $stmt->execute();
=======
require_once 'Conexao.php';

class UsuarioModel {
    public static function buscarPorEmail($email) {
        $bd = Conexao::getConexao(); // <- pega a conexão corretamente
        if (!$bd) {
            die('Erro: Conexão com o banco de dados não foi estabelecida.');
        }

        $stmt = $bd->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();
        $stmt->close();
        return $usuario ?: null;
    }

    public static function cadastrar($email, $senha, $funcao) {
        $bd = Conexao::getConexao();
        if (!$bd) {
            die('Erro: Conexão com o banco de dados não foi estabelecida.');
        }

        $stmt = $bd->prepare("INSERT INTO usuarios (email, senha, funcao) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $email, $senha, $funcao);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
>>>>>>> Stashed changes
}
