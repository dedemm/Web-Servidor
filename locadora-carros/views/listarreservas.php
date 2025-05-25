<?php
require_once __DIR__ . '/../database/conexao.php';
global $bd;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

$idUsuario = $_SESSION['id_usuario'];

$sql = "
    SELECT r.placa, r.data, c.modelo, c.ano, c.cor
    FROM reservas r
    JOIN carros c ON r.placa = c.placa
    WHERE r.id_usuario = ?
";

$stmt = $bd->prepare($sql);
$stmt->bind_param("i", $idUsuario); // "i" = integer
$stmt->execute();
$resultado = $stmt->get_result();
$reservas = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<h1>Minhas Reservas</h1>
<link rel="stylesheet" type="text/css" href="CSS/style.css" media="screen" />

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
            <tr>
                <td><?= htmlspecialchars($reserva['placa']) ?></td>
                <td><?= htmlspecialchars($reserva['modelo']) ?></td>
                <td><?= htmlspecialchars($reserva['ano']) ?></td>
                <td><?= htmlspecialchars($reserva['cor']) ?></td>
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
