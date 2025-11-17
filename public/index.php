<?php
session_start();

// Load controllers
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/BookController.php';

$userController = new UserController();
$bookController = new BookController();

// Route picker
$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My MVC App</title>

    <!-- 🔥 CSS Correct -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
// ──────────────────────────────
//           ROUTES
// ──────────────────────────────
switch ($action) {
    case 'home':
        $userController->home();
        break;

    case 'register':
        $userController->register();
        break;

    case 'login':
        $userController->login();
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'create':
    case 'edit':
    case 'delete':
    case 'list':
        $bookController->$action($id);
        break;

    default:
        echo "<h2>Page not found.</h2>";
}
?>

    <!-- 🔥 JS Correct -->
    <script src="js/validation.js"></script>
</body>
</html>
