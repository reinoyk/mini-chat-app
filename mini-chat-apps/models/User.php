<?php
class User {
    public static function register($conn, $fullname, $email, $address, $username, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user (fullname, email, address, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fullname, $email, $address, $username, $password);
        return $stmt->execute();
    }
    public static function login($conn, $username, $password) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result && password_verify($password, $result['password'])) {
            return $result;
        }
        return false;
    }
    public static function getAllExcept($conn, $user_id) {
        $stmt = $conn->prepare("SELECT user_id, fullname FROM user WHERE user_id != ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function getById($conn, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
