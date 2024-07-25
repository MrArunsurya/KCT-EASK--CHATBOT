<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['student-username'];
    $password = $_POST['student-password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'Student'");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['student_id'] = $user['id']; // Store student ID in session
        // Redirect to student dashboard or wherever needed
        header("Location: student_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
