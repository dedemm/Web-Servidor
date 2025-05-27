<?php

require 'vendor/autoload.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processarLogin();
        } else {
            $this->exibirFormularioLogin();
        }
    }

    private function processarLogin()
    {
        //session_start();

        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscarPorEmail($email);

        if ($usuario &&  $usuario->senha == $senha) {
            $_SESSION['usuario'] = $usuario->email;
            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['funcao'] = $usuario->funcao;

            header('Location: /home');
            exit();
        }

        $erro = 'Email ou senha incorretos!';
        $this->exibirFormularioLogin($erro);
    }

    private function exibirFormularioLogin($erro = null)
    {
        include __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processarCadastro();
        } else {
            $this->exibirFormularioCadastro();
        }
    }

    private function processarCadastro()
    {
       //session_start();

        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $funcao = $_POST['funcao'] ?? '';

        $usuarioModel = new UsuarioModel();
        if ($usuarioModel->buscarPorEmail($email)) {
            $erro = "Usuário já existe.";
            $this->exibirFormularioCadastro($erro);
            return;
        }


        $usuarioModel->email = $email;
        $usuarioModel->senha = $senha;
        $usuarioModel->funcao = $funcao;

        $res = $usuarioModel->cadastrar();

        if ($res) {
            $_SESSION['usuario'] = $email;
            $_SESSION['funcao'] = $funcao;
            header('Location: /login');
            exit();
        }

        $erro = "Erro ao cadastrar usuário. Tente novamente.";
        $this->exibirFormularioCadastro($erro);
    }

    private function exibirFormularioCadastro( $erro = null)
    {
        include __DIR__ . '/../views/cadastro.php';
    }
}
