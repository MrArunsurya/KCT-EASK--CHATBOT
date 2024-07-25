<?php
// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email and query from the POST data
    $email = $_POST["email"];
    $query = $_POST["query"];

    // Connect to your database
    $conn = new mysqli("localhost", "dbuser", "dbpassword", "question");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to insert the data into the database
    $stmt = $conn->prepare("INSERT INTO queries (email, query) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $query);
    if ($stmt->execute() === TRUE) {
        // Data inserted successfully
        echo "Data inserted successfully!";
    } else {
        // Error inserting data into the database
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
