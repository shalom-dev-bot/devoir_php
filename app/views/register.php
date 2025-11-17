<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h1>Inscription</h1>
    <?php require 'partials/flash.php'; ?>
    <form method="POST">
        <input type="hidden" name="csrf" value="<?= generateCsrfToken() ?>">
        <input type="text" name="username" placeholder="Pseudo" required minlength="3"><br><br>
        <input type="password" name="password" placeholder="Mot de passe" required minlength="6"><br><br>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="/login">Connexion</a></p>
</body>
</html>