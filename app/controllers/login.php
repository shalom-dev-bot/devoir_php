<?php
use App\Models\User;
use function App\Core\verifyCsrfToken;
use function App\Core\flash;
use function App\Core\redirect;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf'] ?? '')) {
        flash("Token invalide.", "danger");
        redirect('/login');
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $userId = User::login($username, $password);

    if ($userId) {
        // Régénère l'ID de session après login (anti session fixation)
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
        flash("Bienvenue, $username !", "success");
        redirect('/books');
    } else {
        flash("Mauvais identifiants.", "danger");
    }
}

$csrf = generateCsrfToken();
require '../views/login.php';