<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (fullname, role, email, phone, dob, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$fullname, $role, $email, $phone, $dob, $password]);

    echo "Registration successful!";
}
?>
