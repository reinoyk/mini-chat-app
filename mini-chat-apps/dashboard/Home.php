<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';
require_once '../models/Party.php';
require_once '../models/Group.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$users = User::getAllExcept($conn, $user_id);
$chats = Party::getAllForUser($conn, $user_id);
?>

<?php include '../partials/header.php'; ?>


<div class="main-center-box">
    <h2>Welcome, <span style="color:#2673e4"><?= htmlspecialchars($_SESSION['fullname']) ?></span></h2>
    <div class="header-user">
        <span class="user-icon">
            <!-- SVG simple user icon -->
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" fill="#2673e4"/>
                <ellipse cx="12" cy="18" rx="8" ry="5" fill="#8cb4f3"/>
            </svg>
        </span>
        <a href="profile.php" class="profile-link"></a>
    </div>
    <div class="section">
        <h3>Start New Chat</h3>
        <ul class="user-list">
            <?php while($row = $users->fetch_assoc()): ?>
                <li>
                    <?= htmlspecialchars($row['fullname']) ?> 
                    <a href="../chat/chat_room.php?uid=<?= $row['user_id'] ?>" class="btn-link">Chat</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div class="section">
        <h3>Your Chats</h3>
        <ul class="chat-list">
            <?php while($chat = $chats->fetch_assoc()): ?>
                <?php
                    $other_user_id = Party::getOtherUserId($chat, $user_id);
                    $other_user = User::getById($conn, $other_user_id);
                ?>
                <li>
                    <a href="../chat/chat_room.php?pid=<?= $chat['parties_id'] ?>" class="btn-link">
                        <?= htmlspecialchars($other_user['fullname']) ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div class="section">
        <h3>Your Groups</h3>
        <ul class="user-list">
            <?php
            $groups = Group::getGroupsForUser($conn, $user_id);
            if ($groups->num_rows == 0) {
                echo "<li>No group joined yet.</li>";
            }
            while($group = $groups->fetch_assoc()):
            ?>
                <li>
                    <?= htmlspecialchars($group['group_name']) ?>
                    <a href="../chat/group_room.php?gid=<?= $group['group_id'] ?>" class="btn-link">Enter</a>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="create_group.php" class="btn-link" style="margin-top:8px;display:inline-block;">+ Create Group</a>
    </div>
    <a href="../public/logout.php" class="logout-link">Logout</a>
</div>

<?php include '../partials/footer.php'; ?>
