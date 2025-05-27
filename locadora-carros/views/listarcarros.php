<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('/login');
    exit();
}
?>

<?php if (isset($_SESSION['mensagem'])): ?>
    <div class="mensagem <?= $_SESSION['mensagem']['tipo'] ?>">
        <?= htmlspecialchars($_SESSION['mensagem']['texto']) ?>
    </div>
    <?php unset($_SESSION['mensagem']); ?>
<?php endif; ?>


<h1>Lista de Carros Disponíveis</h1>
<link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />
<table border="1" cellpadding="10">
    <tr>
        <th>Modelo</th>
        <th>Ano</th>
        <th>Cor</th>
        <th>Ação</th>
    </tr>

    <?php foreach ($carros as $carro): ?>
        <tr>
            <td><?= $carro['modelo'] ?></td>
            <td><?= $carro['ano'] ?></td>
            <td><?= $carro['cor'] ?></td>
            <td>
                <form method="POST" action="/reservar">
                    <input type="hidden" name="placa" value="<?= $carro['placa'] ?>">
                    <label for="data_<?= $carro['placa'] ?>">Data:</label>
                    <input type="date" id="data_<?= $carro['placa'] ?>" name="data" required>
                    <button type="submit">Reservar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<form action="/home" method="get" style="margin-bottom: 15px;">
    <button type="submit">Voltar para página inicial</button>
</form>
