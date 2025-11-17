<?php
use App\Models\User;
use function App\Core\generateCsrfToken;
use function App\Core\verifyCsrfToken;
use function App\Core\flash;
use function App\Core\redirect;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification CSRF
    if (!verifyCsrfToken($_POST['csrf'] ?? '')) {
        flash("Token invalide.", "danger");
        redirect('/register');
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3 || strlen($password) < 6) {
        flash("Pseudo ≥ 3 caractères, mot de passe ≥ 6.", "danger");
    } elseif (User::register($username, $password)) {
        flash("Inscription réussie ! Tu peux te connecter.", "success");
        redirect('/login');
    } else {
        flash("Ce pseudo est déjà pris.", "danger");
    }
}

$csrf = generateCsrfToken();
require '../views/register.php';