<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = User::login($conn, $username, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: ../dashboard/home.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini Chat</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="center-container">
    <form method="POST">
        <h2>Login</h2>
        <?php if($error) echo "<div class='error-message'>$error</div>"; ?>
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </form>
</body>
</html>
