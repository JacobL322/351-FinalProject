<?php
// register.php - Registration page
session_start();
require_once 'config.php';
require_once 'auth.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        if ($password !== $confirm_password) {
            $error_message = 'Passwords do not match';
        } else if (strlen($password) < 6) {
            $error_message = 'Password must be at least 6 characters';
        } else {
            if (register_user($pdo, $username, $password)) {
                $success_message = 'Registration successful! You can now login.';
            } else {
                $error_message = 'Username already exists';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - The Animal Archive</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h1>Sign Up</h1>
        <?php if ($error_message): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <div class="success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="" class="login-form">
            <div class = "login-row">
                <input type="text" class = "form-input" placeholder = "Username" id="username" name="username" required>
                <label for="username" class = "form-label">Username:</label>
            </div>
            <div class = "login-row">
                <input type="password" class = "form-input" placeholder = "Password" id="password" name="password" required>
                <label for="password" class = "form-label">Password:</label>
            </div>
            <div class = "login-row">
                <input type="password" class = "form-input" placeholder = "Password" id="confirm_password" name="confirm_password" required>
                <label for="confirm_password" class = "form-label">Confirm Password:</label>
            </div>
            <button type="submit" name="register" class = "submit-button">Register</button>
        </form>
        <p>Already have an account? <a href="login.php" class = "sign-up-text">Login here</a></p>
    </div>
</body>
</html>