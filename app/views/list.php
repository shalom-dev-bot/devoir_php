<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <h1>Book List</h1>
    <a href="index.php?action=create">Add New Book</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($books as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['title'] ?></td>
            <td><?= $b['author'] ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $b['id'] ?>">Edit</a> |
                <a href="index.php?action=delete&id=<?= $b['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
