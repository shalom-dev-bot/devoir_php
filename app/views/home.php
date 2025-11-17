<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

    <h1>
        Welcome 
        <?php echo isset($_SESSION['user']) 
                ? htmlspecialchars($_SESSION['user']['username']) 
                : 'Guest'; ?>
        !
    </h1>

    <?php if(isset($_SESSION['user'])): ?>
        <a href="index.php?action=logout">Logout</a>
        <a href="index.php?action=list">Go to Books</a>
    <?php else: ?>
        <a href="index.php?action=login">Login</a>
        <a href="index.php?action=register">Register</a>
    <?php endif; ?>

</body>
</html>
