<?php
namespace App\Models;

use App\Config\Database;

class User {
    private $conn;
    private $table = 'User';
    
    public $id;
    public $name;
    public $age;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    
    public function getAll() {
        $query = "SELECT * FROM {$this->table} ORDER BY Id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function getById() {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if($row) {
            $this->name = $row['Name'];
            $this->age = $row['Age'];
            return true;
        }
        
        return false;
    }
    
    public function create() {
        $query = "INSERT INTO {$this->table} (Name, Age) VALUES (:name, :age)";
        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->age = htmlspecialchars(strip_tags($this->age));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':age', $this->age);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Erro: %s.\n", $stmt->errorCode());
        return false;
    }
    
    public function update() {
        $query = "UPDATE {$this->table} SET Name = :name, Age = :age WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Limpar e vincular dados
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->age = htmlspecialchars(strip_tags($this->age));
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':age', $this->age);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Erro: %s.\n", $stmt->errorCode());
        return false;
    }
    
    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Limpar e vincular dados
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        printf("Erro: %s.\n", $stmt->errorCode());
        return false;
    }
}