<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: index.html");
    exit();
}
require 'db.php';

// Rest of the code...

<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student-id'];
    $fileName = $_FILES['hallticket']['name'];
    $fileTmpName = $_FILES['hallticket']['tmp_name'];
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . basename($fileName);

    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Move uploaded file to the uploads directory
    if (move_uploaded_file($fileTmpName, $filePath)) {
        $sql = "INSERT INTO hall_tickets (student_id, file_name, file_path) VALUES (?, ?, ?)";
        $stmt= $conn->prepare($sql);
        if ($stmt->execute([$studentId, $fileName, $filePath])) {
            echo "File uploaded successfully!";
        } else {
            echo "Failed to store file information in the database.";
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>
