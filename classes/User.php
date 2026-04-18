<?php
class User {
    private $conn;
    private $table = "Users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $password) {
        $sql = "INSERT INTO " . $this->table . " (username, email, password, role) VALUES (?, ?, ?, 'CUSTOMER')";
        $stmt = $this->conn->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$username, $email, $hashed_password]);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function isAdmin() {
        return (isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN');
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}