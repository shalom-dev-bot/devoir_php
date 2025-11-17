<?php
// public/index.php

// 1. Démarre la session PHP
session_start();

// 2. Régénère l'ID de session pour la sécurité (on explique après)
if (!isset($_SESSION['init'])) {
    session_regenerate_id(true);
    $_SESSION['init'] = true;
}

// 3. Charge l'autoloader qu'on va créer juste après
require_once __DIR__ . '/../autoload.php';

// 4. Charge nos fonctions utilitaires
require_once __DIR__ . '/../app/core/functions.php';

// 5. Récupère l'URL demandée proprement
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 6. Routeur ultra simple : on décide quel fichier exécuter selon l'URL
match ($uri) {
    '/'                     => require '../app/controllers/home.php',
    '/register'             => require '../app/controllers/register.php',
    '/login'                => require '../app/controllers/login.php',
    '/logout'               => require '../app/controllers/logout.php',
    '/books'                => require '../app/controllers/books.php',
    '/books/create'         => require '../app/controllers/book_create.php',
    '/books/delete'         => require '../app/controllers/book_delete.php',
    default                 => http_response_code(404) && require '../app/views/404.php',
};