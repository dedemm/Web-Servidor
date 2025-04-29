<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$reservas = include(__DIR__ . '/../data/reservas.php');
$carros = include(__DIR__ . '/../data/carros.php');
?>

<h1>Minhas Reservas</h1>
<link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />

<?php 
$minhasReservas = array_filter($reservas, fn($r) => $r['usuario'] === $_SESSION['usuario']);

if (count($minhasReservas) > 0): ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Data</th>
        </tr>
        <?php foreach ($minhasReservas as $reserva): ?>
            <?php
                $placa = $reserva['placa'];
                $carro = array_filter($carros, fn($c) => $c['placa'] === $placa);
                $carro = reset($carro);
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
<form action="index.php" method="get" style="margin-bottom: 15px;">
    <button type="submit">Voltar para página inicial</button>
</form>
