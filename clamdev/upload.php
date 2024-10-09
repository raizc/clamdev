<?php
function uploadTaskFile($taskId, $file)
{
    // Database connection
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "clam";
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if file was uploaded without errors
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = basename($file['name']);
        $uploadDir = 'uploads/'; // Directory to store uploaded files

        // Create upload directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Define the file's destination path
        $destination = $uploadDir . $fileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destination)) {
            // Prepare SQL statement to insert the file path and task ID into the database
            $stmt = $conn->prepare("INSERT INTO file (TaskID, File) VALUES (?, ?)");
            $stmt->bind_param("is", $taskId, $destination);

            // Execute the query and check if it was successful
            if ($stmt->execute()) {
                echo "File uploaded and stored successfully.";
            } else {
                echo "Failed to store file in database.";
            }

            $stmt->close();
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }

    $conn->close();
}

// Example usage of the function
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['TaskID']) && isset($_FILES['file'])) {
    $taskId = intval($_POST['TaskID']);
    $file = $_FILES['file'];
    uploadTaskFile($taskId, $file);
}
?>
