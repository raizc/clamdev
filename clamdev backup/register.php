<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "clam";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $LastName = $_POST['lname'];
    $FirstName = $_POST['fname'];
    $MiddleName = $_POST['mname'];
    $UserID = $_POST['idnum'];
    $College = $_POST['college'];
    $Password = $_POST['pword'];
    $ConfirmPassword = $_POST['cpword'];
    $Email = $_POST['email'];

    // Automatically assign the role of 'lead instructor'
    $RoleDescription = "lead instructor"; 

    // Check if password and confirm password match
    if ($Password !== $ConfirmPassword) {
        // Show alert if passwords don't match
        echo "<script>alert('Passwords do not match!'); window.location.href='register.html';</script>";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM user1 WHERE email = ?");
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email Already Exists');</script>";
        } else {
            // Insert user data with 'lead instructor' role
            $insertQuery = "INSERT INTO user1 (LastName, FirstName, MiddleName, UserID, College, Password, email, RoleDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssssssss", $LastName, $FirstName, $MiddleName, $UserID, $College, $Password, $Email, $RoleDescription);

            if ($stmt->execute()) {
                echo "<script>alert('Registration Successful! Redirecting to login page...');</script>";
                echo "<script>window.location.href = 'index.html';</script>";
                exit(); // It's good practice to call exit after a header redirect
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>