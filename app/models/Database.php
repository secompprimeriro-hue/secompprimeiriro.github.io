<?php
class DB {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        require_once __DIR__ . '/../../config/database.php';
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function fetchOne($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function insert($table, $data) {
        $fields = array_keys($data);
        $values = array_values($data);
        $placeholders = array_fill(0, count($fields), '?');
        
        $sql = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";
        $this->query($sql, $values);
        return $this->conn->lastInsertId();
    }
    
    public function update($table, $data, $where, $whereParams = []) {
        $fields = array_map(function($field) {
            return "$field = ?";
        }, array_keys($data));
        
        $values = array_values($data);
        $values = array_merge($values, $whereParams);
        
        $sql = "UPDATE $table SET " . implode(',', $fields) . " WHERE $where";
        $this->query($sql, $values);
        return true;
    }
}
?>