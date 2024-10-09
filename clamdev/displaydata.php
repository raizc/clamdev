<?php
include 'db_connect.php'; // Assuming this file contains the database connection code

// Log the received department parameter
error_log('Received department: ' . $_GET['department']);

// Check if the department parameter is set
if (isset($_GET['department']) && !empty($_GET['department'])) {
    $department = $_GET['department'];

    // Fetch coordinators and lead instructors for the specified department
    $coordinatorsQuery = "SELECT * FROM user1 WHERE RoleDescription = 'coordinator' AND College = ?";
    $teachersQuery = "SELECT * FROM user1 WHERE RoleDescription = 'lead instructor' AND College = ?";

    // Prepare and execute the coordinators query
    $stmt = $conn->prepare($coordinatorsQuery);
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $coordinatorsResult = $stmt->get_result();
    $coordinators = $coordinatorsResult->fetch_all(MYSQLI_ASSOC);

    // Prepare and execute the teachers query
    $stmt = $conn->prepare($teachersQuery);
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $teachersResult = $stmt->get_result();
    $teachers = $teachersResult->fetch_all(MYSQLI_ASSOC);

    // Return the data as JSON
    echo json_encode([
        'coordinators' => $coordinators,
        'teachers' => $teachers
    ]);
} else {
    // Log the error
    error_log('Department parameter is missing');
    
    // Return an error if the department parameter is missing
    echo json_encode([
        'error' => 'Department parameter is missing'
    ]);
}
?>
