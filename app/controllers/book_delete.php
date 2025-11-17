<?php
use App\Models\Book;
use function App\Core\{flash, redirect, isLoggedIn, requireOwnership};

if (!isLoggedIn()) {
    redirect('/login');
}

$id = (int)($_GET['id'] ?? 0);
$book = Book::findByUser($id, $_SESSION['user_id']);

if ($book && Book::delete($id, $_SESSION['user_id'])) {
    flash("Livre supprimé.", "success");
} else {
    flash("Impossible de supprimer ce livre.", "danger");
}
redirect('/books');