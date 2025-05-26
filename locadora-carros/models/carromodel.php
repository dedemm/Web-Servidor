<?php
<<<<<<< Updated upstream

require_once __DIR__ . '/../database/conexao.php';

function buscarTodosCarros() {

    global $bd;
    $query = $bd->query("SELECT * FROM carros");
    $carros = [];
   
    while($row  = $query->fetch_object()){
        $carros[] = $row; 

    }

    return $carros;
}
function buscarCarroPorPlaca($placa) {
    
    global $bd;
    $stmt = $bd->prepare("SELECT * FROM carros WHERE placa = ?");
    $stmt->bind_param("s", $placa);  
    $stmt->execute();
    $resultado = $stmt->get_result();

    return $resultado->fetch_object();  
    
}


function salvarCarro($modelo, $ano, $cor, $placa) {
    global $bd;
    $stmt = $bd->prepare("INSERT INTO carros (modelo, ano, cor, placa, disp) VALUES (?, ?, ?, ?, 'sim')");
    $stmt->bind_param("siss", $modelo, $ano, $cor, $placa);
    return $stmt->execute();


}


?>

=======
require_once 'Conexao.php';

class CarroModel {
    public static function listarTodos() {
        $conn = Conexao::getConexao();
        $resultado = $conn->query("SELECT * FROM carros");
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public static function existePlaca($placa) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM carros WHERE placa = ?");
        $stmt->bind_param('s', $placa);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public static function cadastrar($modelo, $placa, $ano, $cor) {
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare("INSERT INTO carros (modelo, placa, ano, cor, disp) VALUES (?, ?, ?, ?, 'sim')");
        $stmt->bind_param('ssis', $modelo, $placa, $ano, $cor);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
?>
>>>>>>> Stashed changes
