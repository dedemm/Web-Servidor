<h1>Gerenciar Usuários</h1>
<link rel="stylesheet" type="text/css" href="/CSS/style.css" media="screen" />

<?php if (count($usuarios) > 0): ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Função</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['funcao']) ?></td>
                <td>
                    <form action="/editar_usuario/<?= urlencode($usuario['id_usuario']) ?>" method="get" style="display:inline;">
                        <button type="submit">Editar</button>
                    </form>
                    <form action="/excluir_usuario/<?= urlencode($usuario['id_usuario']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if (isset($_SESSION['mensagem'])): ?>
    <div class="<?= $_SESSION['mensagem']['tipo'] ?>">
        <?= $_SESSION['mensagem']['texto'] ?>
    </div>
    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>
<?php else: ?>
    <p>Nenhum usuário cadastrado.</p>
<?php endif; ?>

<br>
<form action="/home" method="get">
    <button type="submit">Voltar para página inicial</button>
</form>
