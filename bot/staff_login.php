<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['staff-username'];
    $password = $_POST['staff-password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'Staff'");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['staff_id'] = $user['id']; // Store staff ID in session
        header("Location: staff_upload.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
