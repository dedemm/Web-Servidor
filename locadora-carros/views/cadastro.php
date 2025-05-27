<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />
</head>
<body>
    <div class="container">
    <h2>Cadastre-se</h2>

    <?php if (!empty($erro)) : ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form action="/cadastrar" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" autocomplete="off" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" autocomplete="new-password" required><br><br>



        <button type="submit">Cadastrar</button>
    </form>

    <p>Já possui uma conta? <a href="/login">Faça login</a></p>
    </div>
</body>
</html>
