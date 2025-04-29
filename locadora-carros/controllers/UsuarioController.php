<?php

class UsuarioController {

    public function login() {

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarios = include_once(__DIR__ . '/../data/usuarios.php');


            if(isset($usuarios[$email]) && $usuarios[$email]['senha'] == $senha){
                session_start();
                $_SESSION['usuario'] = $email;
                $_SESSION['funcao'] = $usuarios[$email]['funcao'];

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
            session_destroy(); 
            header('Location: login.php'); 
            exit();
        }

        public function cadastrar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                session_start();
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $funcao = $_POST['funcao'];
        
                $usuarios = include(__DIR__ . '/../data/usuarios.php');
        
                if (isset($usuarios[$email])) {
                    $erro = "Usuário já existe.";
                    include(__DIR__ . '/../views/cadastro.php');
                } else {
                    $usuarios[$email] = [
                        'senha' => $senha,
                        'funcao' => $funcao
                    ];
                    file_put_contents(__DIR__ . '/../data/usuarios.php', '<?php return ' . var_export($usuarios, true) . ';');
        
                    $_SESSION['usuario'] = $email;
                    $_SESSION['funcao'] = $funcao;
                    header('Location: routes.php?rota=login');
                    exit();
                }
            } else {
                include(__DIR__ . '/../views/cadastro.php');
            }
        }
        
 }

?>