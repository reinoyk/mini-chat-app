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
<h2>Private Chat</h2>
<div id="chat-box" style="border:1px solid #ccc; height:300px; overflow-y:scroll; padding:10px;">
    <?php while($msg = $messages->fetch_assoc()): ?>
        <div><b><?= htmlspecialchars(User::getById($conn, $msg['message_sender'])['fullname']) ?>:</b> <?= htmlspecialchars($msg['message']) ?> <small>(<?= $msg['timestamp'] ?>)</small></div>
    <?php endwhile; ?>
</div>
<form id="chat-form" method="POST">
    <input type="hidden" name="parties_id" value="<?= $parties_id ?>">
    <input type="text" name="message" id="message-input" required autocomplete="off">
    <button type="submit">Send</button>
</form>
<a href="../dashboard/home.php">Back</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#chat-form').submit(function(e){
    e.preventDefault();
    $.post('send_message.php', $(this).serialize(), function(){
        $('#message-input').val('');
        $('#chat-box').load(window.location.href + " #chat-box > *");
    });
});
setInterval(function(){
    $('#chat-box').load(window.location.href + " #chat-box > *");
}, 2000);
</script>
<?php include '../partials/footer.php'; ?>
