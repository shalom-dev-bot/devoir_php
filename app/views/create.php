<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <h1>Add Book</h1>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required><br><br>
        <label>Author:</label>
        <input type="text" name="author" required><br><br>
        <button type="submit">Add Book</button>
    </form>
    <a href="index.php?action=list">Back to List</a>
</body>
</html>
