<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    // Home page
    public function home() {
        require __DIR__ . '/../views/home.php';
    }

    // Register
    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $this->user->username = $username;
            $this->user->email = $email;
            $this->user->password = $password;

            if($this->user->register()) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $error = "Registration failed.";
            }
        }

        require __DIR__ . '/../views/register.php';
    }

    // Login
    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            $user = $this->user->login($email, $password);
            if($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php?action=home");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }

        require __DIR__ . '/../views/login.php';
    }

    // Logout
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
