<?php
session_start();
require_once '../config/db.php';
require_once '../models/Party.php';
require_once '../models/Chat.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

if (isset($_GET['uid'])) {
    $other_user_id = intval($_GET['uid']);
    $parties_id = Party::getOrCreate($conn, $user_id, $other_user_id);
} elseif (isset($_GET['pid'])) {
    $parties_id = intval($_GET['pid']);
} else {
    die('Invalid access.');
}

$messages = Chat::getMessages($conn, $parties_id);
?>
<?php include '../partials/header.php'; ?>

<div class="chat-center-container">
    <div class="chat-card">
        <div class="chat-title">
            <b>Private Chat</b>
        </div>
        <div id="chat-box" class="chat-box">
            <?php while($msg = $messages->fetch_assoc()): ?>
                <div class="chat-msg <?= $msg['message_sender']==$user_id ? 'chat-me' : 'chat-other' ?>">
                    <span class="chat-name">
                        <?= htmlspecialchars(User::getById($conn, $msg['message_sender'])['fullname']) ?>
                    </span>
                    <span class="chat-text"><?= htmlspecialchars($msg['message']) ?></span>
                    <span class="chat-time"><?= date('H:i', strtotime($msg['timestamp'])) ?></span>
                </div>
            <?php endwhile; ?>
        </div>
        <form id="chat-form" method="POST" class="chat-form">
            <input type="hidden" name="parties_id" value="<?= $parties_id ?>">
            <input type="text" name="message" id="message-input" required autocomplete="off" placeholder="Type your message...">
            <button type="submit" class="send-btn" aria-label="Send">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 20.5L21 12L3 3.5V10.5L17 12L3 13.5V20.5Z" fill="currentColor"/>
                </svg>
            </button>
        </form>
        <a href="../dashboard/home.php" class="back-link">← Back</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Send message
$('#chat-form').submit(function(e){
    e.preventDefault();
    $.post('send_message.php', $(this).serialize(), function(){
        $('#message-input').val('');
        $('#chat-box').load(window.location.href + " #chat-box > *", function() {
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        });
    });
});
// Auto reload
setInterval(function(){
    $('#chat-box').load(window.location.href + " #chat-box > *", function() {
        $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
    });
}, 2000);
// Auto-scroll on load
$(document).ready(function(){
    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
});
</script>
<?php include '../partials/footer.php'; ?>
