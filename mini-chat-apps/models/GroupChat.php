<?php
class GroupChat {
    public static function getMessages($conn, $group_id) {
        $stmt = $conn->prepare("SELECT * FROM group_messages WHERE group_id=? ORDER BY timestamp ASC");
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function sendMessage($conn, $group_id, $sender_id, $message) {
        $stmt = $conn->prepare("INSERT INTO group_messages (group_id, sender_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $group_id, $sender_id, $message);
        return $stmt->execute();
    }
}
?>
