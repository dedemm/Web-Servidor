<?php

require 'vendor/autoload.php';
require_once __DIR__ . '/../models/AdminModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class AdminController
{
    public function listarUsuarios()
    {
        $model = new AdminModel();
        $usuarios = $model->listarTodos();
        include __DIR__ . '/../views/gerenciarusuarios.php';
    }

    public function editarUsuarioForm(int $id)
    {
        $model = new AdminModel();
        $usuario = $model->buscarPorId($id);

        if (!$usuario) {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Usuário não encontrado'];
            header('Location: /gerenciar_usuarios');
            exit();
        }

        include __DIR__ . '/../views/editarusuario.php';
    }

    public function editarUsuario(int $id)
    {
        $model = new AdminModel();
        $usuario = $model->buscarPorId($id);

        if (!$usuario) {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Usuário não encontrado'];
            header('Location: /gerenciar_usuarios');
            exit();
        }

        $novoEmail = $_POST['email'] ?? '';
        $novaFuncao = $_POST['funcao'] ?? '';

        if (empty($novoEmail) || empty($novaFuncao)) {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Preencha todos os campos'];
            header("Location: /editar_usuario/$id");
            exit();
        }

        // Configura dados no objeto
        $model->id_usuario = $id;
        $model->email = $novoEmail;
        $model->funcao = $novaFuncao;

        $resultado = $model->atualizar();

        if ($resultado) {
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Usuário atualizado com sucesso'];
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar usuário'];
        }

        header("Location: /editar_usuario/$id");
        exit();
    }

    public function excluirUsuario(int $id)
    {
        $model = new AdminModel();
        $model->id_usuario = $id;

        try {
            $resultado = $model->excluir();
            $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Usuário excluído com sucesso'];
            
        } catch (Exception $e) {
             $_SESSION['mensagem'] = [
            'tipo' => 'erro',
            'texto' => 'Erro ao excluir usuário: Remova as reservas associadas a ele!'
            ];
         }
        header('Location: /gerenciar_usuarios');
        exit();
        }

       
    
}
