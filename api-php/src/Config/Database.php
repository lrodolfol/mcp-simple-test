<?php
namespace App\Config;

class Database {
    // Parâmetros do banco de dados
    private $host = 'localhost';
    private $db_name = 'testes';
    private $username = 'root';
    private $password = 'sinqia123';
    private $conn;
    
    // Conexão com o banco de dados
    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new \PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
        
        return $this->conn;
    }
}