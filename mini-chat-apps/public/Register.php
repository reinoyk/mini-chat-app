<?php
require_once '../config/db.php';
require_once '../models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (User::register($conn, $fullname, $email, $address, $username, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Registrasi gagal. Username mungkin sudah digunakan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Mini Chat</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Register</h2>
    <?php if($error) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required /><br>
        <input type="email" name="email" placeholder="Email" required /><br>
        <input type="text" name="address" placeholder="Address" required /><br>
        <input type="text" name="username" placeholder="Username" required /><br>
        <input type="password" name="password" placeholder="Password" required /><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>
