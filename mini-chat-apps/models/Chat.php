<?php
class Chat {
    public static function getMessages($conn, $parties_id) {
        $stmt = $conn->prepare("SELECT * FROM priv_chat WHERE parties_id=? ORDER BY timestamp ASC");
        $stmt->bind_param("i", $parties_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function sendMessage($conn, $parties_id, $sender_id, $message) {
        $now = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO priv_chat (parties_id, message_sender, timestamp, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $parties_id, $sender_id, $now, $message);
        return $stmt->execute();
    }
}
?>
