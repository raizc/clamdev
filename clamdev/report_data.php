<?php
// Database connection settings
$host = 'localhost'; // your database host
$dbname = 'clam'; // your database name
$username = 'root'; // your database username
$password = ''; // your database password

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch the data
    $stmt = $pdo->query("SELECT TaskDueDate, TaskSubmission, value FROM task"); // Adjust the query to match your table

    // Fetch all data
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // In case of an error, output it
    echo 'Connection failed: ' . $e->getMessage();
}
?>
