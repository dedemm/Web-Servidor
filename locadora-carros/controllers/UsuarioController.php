<?php

<<<<<<< Updated upstream
require_once __DIR__ . '/../models/usuariomodel.php';

class UsuarioController {


   public function login() {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuario = buscarUsuarioPorEmail($email);

        if ($usuario) {
            if ($usuario['senha'] === $senha) {
                $_SESSION['usuario'] = $email;
                $_SESSION['id_usuario'] = $usuario['id_usuario']; // Armazenar o ID!
                $_SESSION['funcao'] = $usuario['funcao'];

                header('Location: index.php?rota=home');
                exit();
            } else {
                $erro = 'Email ou senha incorretos!';
            }
        } else {
            $erro = 'Email ou senha incorretos!';
        }

        include(__DIR__ . '/../views/login.php');
    } else {
        include(__DIR__ . '/../views/login.php');
    }
}




    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
=======
require 'vendor/autoload.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
>>>>>>> Stashed changes
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $funcao = $_POST['funcao'];

<<<<<<< Updated upstream
            $usuario = buscarUsuarioPorEmail($email);

            if ($usuario) {
                $erro = "Usuário já existe.";
=======
            $usuario = UsuarioModel::buscarPorEmail($email);

            if ($usuario && $usuario['senha'] === $senha) {
                session_start();
                $_SESSION['usuario'] = $email;
                $_SESSION['usuario_id'] = $usuario['id_usuario']; // Usando o nome correto do campo
                $_SESSION['funcao'] = $usuario['funcao'];

                header('Location: /home');
                exit();
            } else {
                $erro = 'Email ou senha incorretos!';
                include(__DIR__ . '/../views/login.php');
            }
        } else {
            include(__DIR__ . '/../views/login.php');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $funcao = $_POST['funcao'];

            $usuarioExistente = UsuarioModel::buscarPorEmail($email);
            if ($usuarioExistente) {
                $erro = "Usuário já existe.";
                include(__DIR__ . '/../views/cadastro.php');
                return;
            }

            $res = UsuarioModel::cadastrar($email, $senha, $funcao);

            if ($res) {
                $_SESSION['usuario'] = $email;
                $_SESSION['funcao'] = $funcao;
                header('Location: /login');
                exit();
            } else {
                $erro = "Erro ao cadastrar usuário. Tente novamente.";
>>>>>>> Stashed changes
                include(__DIR__ . '/../views/cadastro.php');
            } else {
                salvarUsuario($email, $senha, $funcao);
                $_SESSION['usuario'] = $email;
                $_SESSION['funcao'] = $funcao;
                header('Location: index.php');
                exit();
            }
        } else {
            include(__DIR__ . '/../views/cadastro.php');
        }
    }
}
<<<<<<< Updated upstream
 
=======
>>>>>>> Stashed changes

?>