<?php
// edit_task.php

// Database connection
$servername = "localhost";
$username = "root"; // Change as per your MySQL credentials
$password = ""; // Change as per your MySQL credentials
$dbname = "clam"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated task data from the POST request
    $task_id = $_POST['task_id'];
    $TaskDescription = $_POST['task_name'];
    $TaskDueDate = $_POST['due_date'];

    // Prepare SQL UPDATE query
    $stmt = $conn->prepare("UPDATE task SET TaskDescription = ?, TaskDueDate = ? WHERE id = ?");
    $stmt->bind_param("ssi", $TaskDescription, $TaskDueDate, $task_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Task updated successfully!";
    } else {
        echo "Error updating task: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
