<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "clam"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the task name and due date from POST data
    $TaskDescription = $_POST['task'];
    $TaskDueDate = $_POST['due_date'];

    // Check if the task name is from 'Others' input field
    if ($_POST['task'] === 'Others') {
        $TaskDescription = $_POST['other_task'];
    }

    // Validate inputs
    if (empty($TaskDescription) || empty($TaskDueDate)) {
        echo "Please fill out both the task name and due date.";
        exit;
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO task (TaskDescription, TaskDueDate) VALUES (?, ?)");
    $stmt->bind_param("ss", $TaskDescription, $TaskDueDate);

    if ($stmt->execute()) {
        echo "Task added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
