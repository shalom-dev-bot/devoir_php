<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    // Inscription sécurisée
    public static function register(string $username, string $password): bool
    {
        // 1. Vérifie si le pseudo existe déjà
        $stmt = Database::get()->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            return false; // déjà pris
        }

        // 2. Hachage du mot de passe (algorithme recommandé en 2025)
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // 3. Insertion
        $stmt = Database::get()->prepare(
            "INSERT INTO users (username, password) VALUES (?, ?)"
        );
        return $stmt->execute([$username, $hash]);
    }

    // Connexion sécurisée
    public static function login(string $username, string $password): ?int
    {
        $stmt = Database::get()->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return (int)$user['id']; // retourne l'ID si OK
        }
        return null; // mauvais identifiants
    }
}