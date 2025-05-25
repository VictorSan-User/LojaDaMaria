<?php
class Database {
    public static function connect() {
        $host = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'tb_agendamentos';

        $connection = new mysqli($host, $usuario, $senha, $banco);

        if ($connection->connect_error) {
            die("Erro de conexão: " . $connection->connect_error);
        }

        return $connection;
    }
}
?>
