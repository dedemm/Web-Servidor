<h1>Minhas Reservas</h1>
<link rel="stylesheet" type="text/css" href="/CSS/style.css" media="screen" />

<?php if (count($reservas) > 0): ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Data</th>
        </tr>
        <?php foreach ($reservas as $reserva): ?>
            <?php
                $placa = $reserva['placa'];
                $carro = null;
                foreach ($carros as $c) {
                    if ($c['placa'] === $placa) {
                        $carro = $c;
                        break;
                    }
                }
            ?>
            <tr>
                <td><?= htmlspecialchars($placa) ?></td>
                <td><?= htmlspecialchars($carro['modelo'] ?? 'Desconhecido') ?></td>
                <td><?= htmlspecialchars($carro['ano'] ?? 'Desconhecido') ?></td>
                <td><?= htmlspecialchars($carro['cor'] ?? 'Desconhecido') ?></td>
                <td><?= htmlspecialchars($reserva['data']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Você ainda não possui nenhuma reserva.</p>
<?php endif; ?>

<br>
<form action="/listar_carros" method="get" style="margin-bottom: 15px;">
    <button type="submit">Reservar um carro</button>
</form>

<form action="/home" method="get" style="margin-bottom: 15px;">
    <button type="submit">Voltar para página inicial</button>
</form>
