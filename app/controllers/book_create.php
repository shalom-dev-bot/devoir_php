<?php
use App\Models\Book;
use function App\Core\{flash, redirect, isLoggedIn, verifyCsrfToken};

if (!isLoggedIn()) {
    flash("Connecte-toi d'abord !", "danger");
    redirect('/login');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf'] ?? '')) {
        flash("Token invalide.", "danger");
        redirect('/books/create');
    }

    $title  = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');

    if (strlen($title) < 2 || strlen($author) < 2) {
        flash("Tous les champs sont requis.", "danger");
    } elseif (Book::create($title, $author, $_SESSION['user_id'])) {
        flash("Livre ajouté !", "success");
        redirect('/books');
    }
}

$csrf = generateCsrfToken();
require '../views/book_create.php';