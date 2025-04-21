<h1>Lista de Carros</h1>

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
                <form method="POST" action="routes.php?rota=reservar">
                    <input type="hidden" name="placa" value="<?= $carro['placa'] ?>">
                    <input type="hidden" name="data" value="<?= date('Y-m-d') ?>">
                    <button type="submit">Reservar este</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>

<form action="index.php" method="get" style="margin-bottom: 15px;">
    <button type="submit">🏠 Voltar para página inicial</button>
</form>
