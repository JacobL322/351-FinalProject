<?php
// login.php - Login page
session_start();
require_once 'config.php';
require_once 'auth.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (login_user($pdo, $username, $password)) {
            header('Location: crud.php');
            exit;
        } else {
            $error_message = 'Invalid username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - The Animal Archive</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <?php if ($error_message): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="login-form">
            <h1>Login</h1>
            <img src="Animal Archive Logo.png" width= "75px" height = "75px">
            <div class = "login-row">
                <input type="text" class = "form-input" placeholder = "Username" id="username" name="username" required>
                <label for="username" class = "form-label">Username:</label>
            </div>
            <div class = "login-row">
                <input type="password" class = "form-input" placeholder = "password" id="password" name="password" required>
                <label for="password" class = "form-label">Password:</label>
            </div>
            <button type="submit" name="login" class = "submit-button">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php" class = "sign-up-text">Sign Up Here</a></p>
    </div>
</body>
</html>