<?php
session_start();
require_once '../config/db.php';
require_once '../models/Group.php';
require_once '../models/GroupChat.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$group_id = isset($_GET['gid']) ? intval($_GET['gid']) : 0;

// Cek apakah user anggota grup
$member = false;
$members = Group::getMembers($conn, $group_id);
while($m = $members->fetch_assoc()) {
    if ($m['user_id'] == $user_id) {
        $member = true;
        break;
    }
}
if (!$member) die("You are not a member of this group.");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    GroupChat::sendMessage($conn, $group_id, $user_id, $_POST['message']);
    header("Location: group_room.php?gid=$group_id");
    exit;
}

$messages = GroupChat::getMessages($conn, $group_id);
$group = $conn->query("SELECT * FROM groups WHERE group_id = $group_id")->fetch_assoc();
?>

<?php include '../partials/header.php'; ?>
<div class="chat-center-container">
    <div class="chat-card">
        <a href="group_settings.php?gid=<?= $group_id ?>" class="group-settings-btn" title="Group Settings">
            <span aria-hidden="true" style="font-size:1.15em;">⚙️</span>
        </a>
        <div class="chat-title">
            <b><?= htmlspecialchars($group['group_name']) ?></b>
        </div>
        <div id="chat-box" class="chat-box">
            <?php while($msg = $messages->fetch_assoc()): ?>
                <div class="chat-msg <?= $msg['sender_id']==$user_id ? 'chat-me' : 'chat-other' ?>">
                    <span class="chat-name">
                        <?= htmlspecialchars(User::getById($conn, $msg['sender_id'])['fullname']) ?>
                    </span>
                    <span class="chat-text"><?= htmlspecialchars($msg['message']) ?></span>
                    <span class="chat-time"><?= date('H:i', strtotime($msg['timestamp'])) ?></span>
                </div>
            <?php endwhile; ?>
        </div>
        <form method="POST" class="chat-form">
            <input type="text" name="message" required autocomplete="off" placeholder="Type your message...">
            <button type="submit" class="send-btn" aria-label="Send">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.5L21 12L3 3.5V10.5L17 12L3 13.5V20.5Z" fill="currentColor"/>
                </svg>
            </button>
        </form>
        <a href="../dashboard/home.php" class="back-link">← Back</a>
    </div>
</div>
<?php include '../partials/footer.php'; ?>
