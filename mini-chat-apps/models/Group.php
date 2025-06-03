<?php
class Group {
    public static function create($conn, $group_name, $creator_id, $member_ids) {
        $stmt = $conn->prepare("INSERT INTO groups (group_name, creator_id) VALUES (?, ?)");
        $stmt->bind_param("si", $group_name, $creator_id);
        if ($stmt->execute()) {
            $group_id = $conn->insert_id;
            // Tambah creator ke anggota grup
            $stmt2 = $conn->prepare("INSERT INTO group_members (group_id, user_id) VALUES (?, ?)");
            $stmt2->bind_param("ii", $group_id, $creator_id);
            $stmt2->execute();
            // Tambah anggota lain
            foreach ($member_ids as $member_id) {
                if ($member_id != $creator_id) {
                    $stmt2->bind_param("ii", $group_id, $member_id);
                    $stmt2->execute();
                }
            }
            return $group_id;
        }
        return false;
    }

    public static function getGroupsForUser($conn, $user_id) {
        $stmt = $conn->prepare("SELECT g.* FROM groups g
                                JOIN group_members m ON g.group_id = m.group_id
                                WHERE m.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public static function getMembers($conn, $group_id) {
        $stmt = $conn->prepare("SELECT u.* FROM user u
                                JOIN group_members m ON u.user_id = m.user_id
                                WHERE m.group_id = ?");
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
