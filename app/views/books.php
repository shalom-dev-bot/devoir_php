<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes livres</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <h1>Ma bibliothèque</h1>
    <?php require 'partials/flash.php'; ?>
    <?php if (isLoggedIn()): ?>
        <p><a href="/books/create">Ajouter un livre</a> | <a href="/logout">Déconnexion</a></p>
    <?php else: ?>
        <p><a href="/login">Connexion</a> | <a href="/register">Inscription</a></p>
    <?php endif; ?>

    <?php if (empty($books)): ?>
        <p>Aucun livre pour l'instant.</p>
    <?php else: ?>
        <table width="100%">
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><strong><?= e($book['title']) ?></strong> par <?= e($book['author']) ?></td>
                    <td><?= e($book['username']) ?></td>
                    <?php if ($book['user_id'] == ($_SESSION['user_id'] ?? 0)): ?>
                        <td><a href="/books/delete?id=<?= $book['id'] ?>" 
                              onclick="return confirm('Supprimer ?')">Supprimer</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>