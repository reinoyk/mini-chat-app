<?php
session_start();
require_once '../config/db.php';
require_once '../models/Group.php';
require_once '../models/User.php';

// --- Validasi login & cek hak akses
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$group_id = isset($_GET['gid']) ? intval($_GET['gid']) : 0;

// Cek member
$members = Group::getMembers($conn, $group_id);
$is_member = false;
$member_ids = [];
while ($m = $members->fetch_assoc()) {
    $member_ids[] = $m['user_id'];
    if ($m['user_id'] == $user_id) $is_member = true;
}
if (!$is_member) die("You are not a member of this group.");

// Proses Add Member
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_member_id'])) {
    $add_id = intval($_POST['add_member_id']);
    if (!in_array($add_id, $member_ids)) {
        $stmt = $conn->prepare("INSERT INTO group_members (group_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $group_id, $add_id);
        if ($stmt->execute()) {
            $success = "Member added!";
        }
    }
    header("Location: group_settings.php?gid=$group_id");
    exit;
}

// Proses Kick Member
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kick_member_id'])) {
    $kick_id = intval($_POST['kick_member_id']);
    // Jangan sampai admin/creator tidak bisa keluar sendiri (optional)
    $stmt = $conn->prepare("DELETE FROM group_members WHERE group_id=? AND user_id=?");
    $stmt->bind_param("ii", $group_id, $kick_id);
    $stmt->execute();
    header("Location: group_settings.php?gid=$group_id");
    exit;
}

$group = $conn->query("SELECT * FROM groups WHERE group_id = $group_id")->fetch_assoc();
$member_objs = Group::getMembers($conn, $group_id);

// Untuk add: daftar user yang belum di group
$user_objs = User::getAllExcept($conn, $user_id);
$already_in = [];
$res_member = Group::getMembers($conn, $group_id);
while ($u = $res_member->fetch_assoc()) { $already_in[] = $u['user_id']; }
?>
<?php include '../partials/header.php'; ?>
<div class="main-center-box" style="max-width:430px;">
    <h2>Group Settings</h2>
    <h3><?= htmlspecialchars($group['group_name']) ?></h3>
    <div class="group-section">
        <h3 class="member-title">Members :</h3>
        <ul class="group-member-list">
            <?php foreach ($members as $m): ?>
            <li>
                <span class="member-name"><?= htmlspecialchars($m['fullname']) ?></span>
                <?php if ($m['user_id'] == $user_id): ?>
                    <span style="color:#888;font-size:0.96em;">(You)</span>
                <?php else: ?>
                    <div class="kick-form">
                        <input type="hidden" name="kick_id" value="<?= $m['user_id'] ?>">
                        <button type="submit" class="btn-kick">Kick</button>
                    </div>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="group-section">
        <form method="POST" class="add-member-form">
            <select name="add_member_id" required>
                <option value="">Choose user</option>
                <?php while($user = $user_objs->fetch_assoc()):
                    if (!in_array($user['user_id'], $already_in)): ?>
                    <option value="<?= $user['user_id'] ?>"><?= htmlspecialchars($user['fullname']) ?></option>
                <?php endif; endwhile; ?>
            </select>
            <button type="submit">Add Member</button>
        </form>
    </div>
    <a href="group_room.php?gid=<?= $group_id ?>" class="btn-link" style="margin-top:18px;display:inline-block;">← Back to Chat</a>
</div>
<?php include '../partials/footer.php'; ?>
