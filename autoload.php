<?php
// autoload.php
// Situé à la racine du projet
// Remplace complètement le besoin de faire 50 require/include à la main
// Implémente un autoloader "maison" compatible PSR-4 (la norme utilisée par Laravel, Symfony, Composer, etc.)

spl_autoload_register(function ($class) {
    // Namespace de base de notre projet
    $prefix = 'App\\';
    
    // Dossier de base pour toutes nos classes
    $base_dir = __DIR__ . '/app/';
    
    // Est-ce que la classe demandée commence par App\ ?
    // Exemple : App\Controllers\UserController
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Si non → ce n'est pas une de nos classes → on ignore
        return;
    }
    
    // On enlève le préfixe "App\" → reste "Controllers\UserController"
    $relative_class = substr($class, $len);
    
    // On remplace les \ par / et on ajoute .php
    // "Controllers/UserController" devient "controllers/UserController.php"
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Si le fichier existe → on le charge
    if (file_exists($file)) {
        require $file;
    }
});