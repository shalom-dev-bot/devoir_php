<?php
session_start();
require_once '../../models/User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $loggedUser = $user->login($email, $password);
    if ($loggedUser) {
        $_SESSION['user'] = $loggedUser;
        header("Location: home.php");
        exit;
    } else {
        $message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <h1>Login</h1>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
</body>
</html>
