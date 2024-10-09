<?php
// Database connection details
$host = 'localhost';
$dbname = 'clam'; // Replace with your database name
$username = 'root';
$password = '';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch task data where the user role is 'Coordinator'
$sql = "SELECT user1.LastName, task.TaskDueDate, task.TaskDescription 
        FROM task
        JOIN user1 ON task.UserID = user1.UserId
        WHERE user1.RoleDescription = 'coordinator'"; // Fetch only coordinators

// Execute the query and check for errors
if ($result = $conn->query($sql)) {
    $tasks = array(); // Initialize an empty array to hold the tasks

    // If there are results, fetch them into an array
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    } else {
        // No results found, set appropriate message
        $tasks = ['message' => 'No tasks found for coordinators'];
    }
    // Free result set
    $result->free();
} else {
    // If the query fails, output the error
    $tasks = ['error' => 'Query failed: ' . $conn->error];
}

// Set the response content type to JSON
header('Content-Type: application/json');

// Output the data as JSON
echo json_encode($tasks);

// Close the database connection
$conn->close();
?>
