<?php

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

