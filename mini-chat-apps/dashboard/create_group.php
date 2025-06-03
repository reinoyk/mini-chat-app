<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';
require_once '../models/Group.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$users = User::getAllExcept($conn, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_name = $_POST['group_name'];
    $member_ids = isset($_POST['members']) ? $_POST['members'] : [];
    $group_id = Group::create($conn, $group_name, $user_id, $member_ids);
    if ($group_id) {
        header("Location: home.php");
        exit;
    }
}
?>

<?php include '../partials/header.php'; ?>
<div class="center-container">
    <form method="POST" class="profile-form">
        <h2>Create Group</h2>
        <input type="text" name="group_name" placeholder="Group Name" required>
        <label style="font-size:0.98em; margin-bottom:6px;">Add Members:</label>
        <div style="max-height:150px;overflow-y:auto;">
            <?php while($row = $users->fetch_assoc()): ?>
                <label style="display:block;">
                    <input type="checkbox" name="members[]" value="<?= $row['user_id'] ?>">
                    <?= htmlspecialchars($row['fullname']) ?>
                </label>
            <?php endwhile; ?>
        </div>
        <button type="submit">Create</button>
        <a href="home.php" class="back-link">← Back</a>
    </form>
</div>
<?php include '../partials/footer.php' ?>
