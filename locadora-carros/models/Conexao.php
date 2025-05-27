<?php
class Conexao {
    private static ?mysqli $conn = null;

    public static function getConexao(): mysqli {
        if (self::$conn === null) {
            self::$conn = new mysqli('localhost', 'root', '', 'locadora');
            if (self::$conn->connect_error) {
                die('Erro na conexão: ' . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>
