<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $username;
    public $email;
    public $password; // hashed password

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Register new user
    public function register() {
        $sql = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password); // already hashed
        return $stmt->execute();
    }

    // Find user by email
    public function findByEmail($email) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Verify login
    public function login($email, $password) {
        $user = $this->findByEmail($email);
        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
