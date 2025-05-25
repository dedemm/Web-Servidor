<?php

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
}
