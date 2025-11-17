<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <h1>Edit Book</h1>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $bookData['title'] ?>" required><br><br>
        <label>Author:</label>
        <input type="text" name="author" value="<?= $bookData['author'] ?>" required><br><br>
        <button type="submit">Update Book</button>
    </form>
    <a href="index.php?action=list">Back to List</a>
</body>
</html>
