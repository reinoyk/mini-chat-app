<?php
class Party {
    public static function getOrCreate($conn, $user_id, $other_user_id) {
        $stmt = $conn->prepare("SELECT * FROM parties WHERE (initiator=? AND recipient=?) OR (initiator=? AND recipient=?)");
        $stmt->bind_param("iiii", $user_id, $other_user_id, $other_user_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result) return $result['parties_id'];

        $now = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO parties (initiator, recipient, started_at) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $other_user_id, $now);
        $stmt->execute();
        return $conn->insert_id;
    }
    public static function getAllForUser($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM parties WHERE initiator=? OR recipient=? ORDER BY started_at DESC");
        $stmt->bind_param("ii", $user_id, $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function getOtherUserId($party, $my_id) {
        return ($party['initiator'] == $my_id) ? $party['recipient'] : $party['initiator'];
    }
}
?>
