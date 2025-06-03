<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = User::getById($conn, $user_id);

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $status = $_POST['status'];
    $password = $_POST['password'];

    // Jika password diisi, update password juga
    if ($password !== "") {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET fullname=?, email=?, address=?, username=?, status=?, password=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $fullname, $email, $address, $username, $status, $password_hash, $user_id);
    } else {
        $sql = "UPDATE user SET fullname=?, email=?, address=?, username=?, status=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $fullname, $email, $address, $username, $status, $user_id);
    }

    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
        $_SESSION['fullname'] = $fullname;
        $user = User::getById($conn, $user_id); // refresh data
    } else {
        $error = "Failed to update profile.";
    }
}
?>

<?php include '../partials/header.php'; ?>
<div class="center-container">
    <form method="POST" class="profile-form">
        <h2>My Profile</h2>
        <?php if ($success) echo "<div class='success-message'>$success</div>"; ?>
        <?php if ($error) echo "<div class='error-message'>$error</div>"; ?>

        <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" placeholder="Full Name" required>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" placeholder="Address" required>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Username" required>
        <input type="text" name="status" value="<?= htmlspecialchars($user['status']) ?>" placeholder="Status/About Me">
        <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
        <button type="submit">Save Changes</button>
        <a href="home.php" class="back-link">← Back</a>
    </form>
</div>
<?php include '../partials/footer.php'; ?>
