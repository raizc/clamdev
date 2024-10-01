<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection (update with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clam";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['name'])) {
    die(json_encode(["success" => false, "message" => "Invalid input. Department name is required."]));
}

$DepartmentDescription = $data['name'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO department (DepartmentDescription) VALUES (?)");
$stmt->bind_param("s", $DepartmentDescription);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
