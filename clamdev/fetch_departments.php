<?php
header('Content-Type: application/json');

// Database configuration
$host = 'localhost'; // Database host
$db = 'clam'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Query to fetch departments
$sql = "SELECT DepartmentDescription FROM department"; // Adjust the table name and column as necessary
$result = $conn->query($sql);

$departments = [];
if ($result->num_rows > 0) {
    // Fetch all departments
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row; // Append each department as an associative array
    }
} else {
    $departments = []; // No departments found
}

// Close the database connection
$conn->close();

// Return departments as JSON
echo json_encode($departments);
?>
