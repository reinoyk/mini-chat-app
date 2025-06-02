<?php
session_start();
require_once '../config/db.php';
require_once '../models/Chat.php';

if (!isset($_SESSION['user_id'])) exit;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parties_id = intval($_POST['parties_id']);
    $message = trim($_POST['message']);
    $sender_id = $_SESSION['user_id'];
    if ($message != '') {
        Chat::sendMessage($conn, $parties_id, $sender_id, $message);
    }
}
?>
