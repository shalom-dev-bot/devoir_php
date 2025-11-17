<?php
require_once __DIR__ . '/../../config/database.php';

class Book {
    private $conn;
    private $table = 'books';

    public $id;
    public $title;
    public $author;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create
    public function create() {
        $sql = "INSERT INTO " . $this->table . " (title, author) VALUES (:title, :author)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        return $stmt->execute();
    }

    // Read all
    public function read() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    // Read single
    public function readSingle($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Update
    public function update() {
        $sql = "UPDATE " . $this->table . " SET title = :title, author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
