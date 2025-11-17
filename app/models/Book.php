<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Book
{
    public static function all(): array
    {
        $stmt = Database::get()->query(
            "SELECT b.*, u.username 
             FROM books b 
             JOIN users u ON b.user_id = u.id 
             ORDER BY b.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public static function create(string $title, string $author, int $userId): bool
    {
        $stmt = Database::get()->prepare(
            "INSERT INTO books (title, author, user_id) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$title, $author, $userId]);
    }

    public static function delete(int $id, int $userId): bool
    {
        $stmt = Database::get()->prepare(
            "DELETE FROM books WHERE id = ? AND user_id = ?"
        );
        return $stmt->execute([$id, $userId]);
    }

    public static function findByUser(int $id, int $userId): ?array
    {
        $stmt = Database::get()->prepare(
            "SELECT * FROM books WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$id, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}