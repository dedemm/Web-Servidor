<?php
// editar_usuario.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['funcao'] !== 'admin') {
    header('Location: /login');
    exit();
}

require_once __DIR__ . '/../models/AdminModel.php';

$adminModel = new AdminModel();
$usuario = $adminModel->buscarPorId((int)$id);

if (!$usuario) {
    die("Usuário não encontrado.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Editar Usuário</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css" media="screen" />
</head>
<body>
    <div class="container">
    <h1>Editar Usuário</h1>

    <form action="/editar_usuario/<?= urlencode($id) ?>" method="post">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>" />

        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required /><br /><br />

        <label for="funcao">Função:</label><br />
        <select id="funcao" name="funcao" required>
            <option value="admin" <?= $usuario['funcao'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="normal" <?= $usuario['funcao'] === 'normal' ? 'selected' : '' ?>>Normal</option>
        </select><br /><br />

        <button type="submit">Salvar alterações</button>

        <?php
            if (isset($_SESSION['mensagem'])) 
            {
                $tipo = $_SESSION['mensagem']['tipo'];
                $texto = $_SESSION['mensagem']['texto'];

                $classe = $tipo === 'sucesso' ? 'mensagem sucesso' : 'mensagem erro';

                echo "<div class='$classe'>$texto</div>";

                unset($_SESSION['mensagem']);
            }
        ?>
        

    </form>
    <br>

    <p><a href="/gerenciar_usuarios">Voltar à lista de usuários</a></p>
    </div>
</body>
</html>
