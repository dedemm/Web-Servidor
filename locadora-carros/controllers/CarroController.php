<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class CarroController {

    public function listarCarros() {
        $carros = include_once(__DIR__ . '/../data/carros.php');
        include(__DIR__ . '/../views/listarcarros.php');
    }

    public function listarReservas() {
        $carros = include_once(__DIR__ . '/../data/carros.php');
        include(__DIR__ . '/../views/listarreservas.php');
    }
    
    public function reservar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $placa = $_POST['placa'];
            $data = $_POST['data'];
            $usuario = $_SESSION['usuario'];
    
            $caminhoReservas = __DIR__ . '/../data/reservas.php';
            $reservas = file_exists($caminhoReservas) ? include($caminhoReservas) : [];
    
            foreach ($reservas as $reserva) {
                if ($reserva['placa'] === $placa && $reserva['data'] === $data) {
                    echo "<p>Este carro já está reservado para o dia <strong>$data</strong>.</p>";
                    echo "<a href='routes.php?rota=listar_carros'>Voltar à lista de carros</a>";
                    return;
                }
            }
    
            $reservas[] = [
                'usuario' => $usuario,
                'placa' => $placa,
                'data' => $data
            ];
    
            $conteudo = "<?php\nreturn " . var_export($reservas, true) . ";\n?>";
            file_put_contents($caminhoReservas, $conteudo);
    
            echo "<p>Carro com placa <strong>$placa</strong> reservado para o dia <strong>$data</strong>!</p>";
            echo "<a href='routes.php?rota=listar_carros'>Voltar à lista de carros</a>";
        } else {
            echo "<p>Requisição inválida.</p>";
        }
    }

    public function cadastrar_carro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $modelo = $_POST['modelo'];
            $ano = $_POST['ano'];
            $cor = $_POST['cor'];
            $placa = $_POST['placa'];
    
            $carros = include(__DIR__ . '/../data/carros.php');
    
            foreach ($carros as $carro) {
                if ($carro['placa'] === $placa) {
                    $_SESSION['mensagem'] = [
                        'tipo' => 'erro',
                        'texto' => 'Já existe um carro com essa placa cadastrado .'
                    ];
                    header('Location: routes.php?rota=cadastrar_carro');
                    exit();
                }
            }
    
            $carros[] = [
                'modelo' => $modelo,
                'ano' => (int)$ano,
                'cor' => $cor,
                'placa' => $placa,
                'disp' => 'sim'
            ];
    
            file_put_contents(__DIR__ . '/../data/carros.php', '<?php return ' . var_export($carros, true) . ';');
    
            header('Location: routes.php?rota=listar_carros');
            exit();
        } else {
            include(__DIR__ . '/../views/cadastrocarros.php');
        }
    }
    
    
    
    
}

?>