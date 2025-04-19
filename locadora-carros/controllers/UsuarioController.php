<?php

class UsuarioController {

    public function login(){// processa o login

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarios = include_once(__DIR__ . '/../data/usuarios.php');


            if(isset($usuarios[$email]) && $usuarios[$email] == $senha){
                session_start();
                $_SESSION['usuario'] = $email;

                header('Location: index.php');
                exit();

            }else{
                $erro = 'Email ou senha incorretos!';
                include(__DIR__ . '/../views/login.php');
            }
            }else{
                include(__DIR__ . '/../views/login.php');

            }
        }

        public function logout() {
            session_start();
            session_destroy(); // Destroi a sessão
            header('Location: login.php'); // Redireciona para a tela de login
            exit();
        }
 }













?>