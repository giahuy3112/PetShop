<?php
class Database {
    private $host = "localhost";
    private $db_name = "petshop_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
            $this->conn->exec("set names utf8mb4");
=======
            $this->conn->exec("set names utf8mb4");    
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
        } catch (PDOException $e) {
            die("Lỗi kết nối: " . $e->getMessage());
        }
        return $this->conn;
    }
<<<<<<< HEAD
}
?>
=======
}
>>>>>>> 519422940b574c3a92331d71e16eb2b365698251
