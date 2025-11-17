<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <?php require 'partials/flash.php'; ?>
    <form method="POST">
        <input type="hidden" name="csrf" value="<?= generateCsrfToken() ?>">
        <input type="text" name="username" placeholder="Pseudo" required><br><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br><br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas de compte ? <a href="/register">Inscription</a></p>
</body>
</html>