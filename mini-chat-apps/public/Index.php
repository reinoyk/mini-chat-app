<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard/home.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
