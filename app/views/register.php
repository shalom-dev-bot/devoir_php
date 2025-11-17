<?php
session_start();
require_once '../../models/User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $user->username = trim($_POST['username']);
    $user->email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $message = "Passwords do not match!";
    } elseif ($user->findByEmail($user->email)) {
        $message = "Email already registered!";
    } else {
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->register();
        $message = "Registration successful! You can now <a href='login.php'>login</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
</head>
<body>
    <h1>Register</h1>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirm" required>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
