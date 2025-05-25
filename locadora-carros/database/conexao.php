<?php

try{

    $bd = new mysqli('localhost','root','','Locadora');
    $bd->set_charset('utf8');

}catch(Exception $e){

    throw new Exception ('Erro na conexao: ' . $e->GetMessage());
} 




?>