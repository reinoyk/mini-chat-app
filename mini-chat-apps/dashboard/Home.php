<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';
require_once '../models/Party.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$users = User::getAllExcept($conn, $user_id);
$chats = Party::getAllForUser($conn, $user_id);
?>

<?php include '../partials/header.php'; ?>
<h2>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></h2>
<h3>Start New Chat</h3>
<ul>
    <?php while($row = $users->fetch_assoc()): ?>
        <li>
            <?= htmlspecialchars($row['fullname']) ?> 
            <a href="../chat/chat_room.php?uid=<?= $row['user_id'] ?>">Chat</a>
        </li>
    <?php endwhile; ?>
</ul>

<h3>Your Chats</h3>
<ul>
    <?php while($chat = $chats->fetch_assoc()): ?>
        <li>
            <a href="../chat/chat_room.php?pid=<?= $chat['parties_id'] ?>">
                Chat with User ID: <?= Party::getOtherUserId($chat, $user_id) ?>
            </a>
        </li>
    <?php endwhile; ?>
</ul>
<a href="../public/logout.php">Logout</a>
<?php include '../partials/footer.php'; ?>
