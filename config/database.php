<?php
// config/database.php
// Fichier de configuration de la base de données
// NE JAMAIS le mettre dans /public → il contient des identifiants !

define('DB_HOST', 'localhost');
define('DB_NAME', 'bibliotheque');
define('DB_USER', 'root');      // Change si tu as un autre user
define('DB_PASS', '');          // Mets ton mot de passe MySQL ici (ou vide si aucun)

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            // Mode erreurs → exceptions (on veut tout capter)
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            
            // On récupère toujours les résultats en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            
            // Désactive l'émulation des prepared statements → VRAIE sécurité contre les injections SQL
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
);
} catch (PDOException $e) {
    // En production, on ne montre JAMAIS l'erreur brute à l'utilisateur
    die("Erreur de connexion à la base de données. Contacte l'administrateur.");
}