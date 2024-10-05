<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging output
    var_dump($_POST);

    $UserID = $_POST['idnum'];
    $Password = $_POST['pword'];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";  
    $dbname = "clam";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Query with role
    $stmt = $conn->prepare("SELECT RoleDescription FROM user1 WHERE UserID=? AND Password=?");
    $stmt->bind_param("ss", $UserID, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $RoleDescription = $row['RoleDescription'];

        // Call function to handle redirection based on role
        redirectUserByRole($RoleDescription);
    } else {
        echo "Invalid username or password"; // for debugging
    }
    
    $stmt->close();
    $conn->close();
}

// Function to redirect users based on their role
function redirectUserByRole($RoleDescription) {
    switch ($RoleDescription) {
        case 'coordinator':
            header("Location: coordinatorDashboard.html");
            break;
        case 'lead instructor':
            header("Location: instructorDashboard.html");
            break;
        case 'admin':
            header("Location: directordb.html");
            break;
        default:
            echo "Role not recognized.";
            break;
    }
    exit();
}
?>
}