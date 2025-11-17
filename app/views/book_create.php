<!DOCTYPE html>
<html lang="fr">
<head><title>Ajouter un livre</title>
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h1>Ajouter un livre</h1>
    <?php require 'partials/flash.php'; ?>
    <form method="POST">
        <input type="hidden" name="csrf" value="<?= generateCsrfToken() ?>">
        <input type="text" name="title" placeholder="Titre" required><br><br>
        <input type="text" name="author" placeholder="Auteur" required><br><br>
        <button>Ajouter</button>
    </form>
    <p><a href="/books">Retour</a></p>
</body>
</html>