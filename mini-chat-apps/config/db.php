<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'mini_chat';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
