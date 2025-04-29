<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />
</head>
<body>
    <h2>Faça seu Login</h2>

    <?php if (!empty($erro)) : ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form action="routes.php?rota=login" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" autocomplete="off" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" autocomplete="new-password" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="routes.php?rota=cadastrar">Cadastre-se aqui</a></p>
</body>
</html>
