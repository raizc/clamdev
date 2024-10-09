<?php
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

// Fetch tasks from the database
$tasks = [];
$sql = "SELECT * FROM task";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store tasks in an array
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper2dash">
        <div>
            <input class="input-search" type="text" placeholder="Search">
        </div>
        <p class="profile">Admin/Director</p>
        <button class="notif-button" type="button"><i class='bx bxs-envelope' ></i></button>

    </div> 

    <div class="wrappermenu">
        <a href="dashboarddb.html">
            <button class="Dashboard" type="button"><i class='bx bx-doughnut-chart'></i>Dashboard</button>
        </a>
        <a href="directorDashboard.html">
            <button class="Faculty" type="menu"><i class='bx bx-group'></i>Faculty</button>
        </a>
        <a href="directoraddtask.html">
            <button class="Addtask" type="menu"><i class='bx bx-task'></i>Add Task</button>
        </a>
        <a href="directorevaldb.html">
        <button class="Evaluation" type="menu"><i class='bx bx-star'></i>Evaluation</button>
        </a>
        <a href="directorreport.html">
        <button class="Reports" type="menu"><i class='bx bx-file'></i>Reports</button>
        </a>
        <a href="">
        <button class="Request" type="button"><i class='bx bx-envelope'></i>Request</button>
        </a>
        <a href="index.html">
        <button class="Logout" type="button"><i class='bx bx-lock'></i>Log Out</button>
        </a>
    </div>

    <div class="task-list">
        <div class="search-bar">
        <input type="text" placeholder="Search">
        <button>Search</button>
    </div>
    <h3 class="taskh3">Assigned Task</h3>
    
    <?php foreach ($tasks as $task): ?>
        <div class="task-item">
            <span class="task-name"><?= htmlspecialchars($task['TaskDescription']) ?></span>
            <span class="due-date"><?= htmlspecialchars($task['TaskDueDate']) ?></span>
            <button class="edit-task" onclick="editTask(<?= $task['TaskID'] ?>, '<?= htmlspecialchars($task['edit']) ?>', '<?= htmlspecialchars($task['TaskDueDate']) ?>')">
                <i class='bx bx-edit-alt'></i>
            </button>
        </div>
    <?php endforeach; ?>
</div>

<form id="edit-task-form" action="edit_task.php" method="POST" style="display: none;">
    <input type="hidden" id="edit-task-id" name="task_id">
    <input type="hidden" id="edit-task-name" name="task_name">
    <input type="hidden" id="edit-due-date" name="due_date">
</form>

<script>
function editTask(id, name, date) {
    // Simple prompt to get updated task details (for simplicity)
    const updatedName = prompt("Edit task name:", name);
    const updatedDate = prompt("Edit due date (YYYY-MM-DD):", date);

    if (updatedName && updatedDate) {
        // Submit the updated task to the backend using a hidden form
        document.getElementById('edit-task-id').value = id;
        document.getElementById('edit-task-name').value = updatedName;
        document.getElementById('edit-due-date').value = updatedDate;
        document.getElementById('edit-task-form').submit();
    }
}
</script>



</body>



<style>
    .wrapper2dash{
        position: relative;
        width: auto;
        height: 75px;
        background-color: #004721;
    }
    
    .wrappermenu{
        position: relative;
        background-color: whitesmoke;
        left: 3px;
        width: 150px;
        height: 650px;
        border: ridge;
        border-radius: 10px;
        border: none;
    
    }

    .wrappermenu .back{
        background: whitesmoke;
        position: inherit;
        border: none;
        right: -130px;
        top: -10px;
    }
    .wrappermenu .Dashboard{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -110px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;}
    
    .wrappermenu .Faculty{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -110px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
    }
    
    .wrappermenu .Addtask{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -120px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
    }
    
    .wrappermenu .Evaluation{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -130px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
    }
    
    .wrappermenu .Reports{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -140px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
    }
    
    .wrappermenu .Request{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        width: 100%;
        outline: none;
        height: 40px;
        bottom: -150px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
        
    }
    
    .wrappermenu .Logout{
        background: whitesmoke;
        font-size: 15px;
        position: relative;
        bottom: -350px;
        width: 100%;
        outline: none;
        height: 40px;
        border: ridge;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: ease-out 0.5s;
    }

    .wrappermenu .title{
    
        position: relative;
        font-size: 10px;
        bottom: -130px;
        right: -15px;
    
    }
    
    .wrapper2dash .input-search{
        position: relative;
        height: 25px;
        width: 250px;
        border: ridge;
        border-radius: 10px;
        bottom: -30px;
        right: -200px;
        background: #009c4a;
        color: black;
        border: none;
    }
    
    .wrapper2dash .prof-button{
        position: relative;
    }

    .Dashboard i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Faculty i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Addtask i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Evaluation i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Reports i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Request i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    .Logout i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    
    ::placeholder{
        position: relative;
        color: white;
        right: -20px;
    }
    
    .wrapper2dash .notif-button{
        position: relative;
        border: none;
        height: 30px;
        width: 30px;
        border: none;
        background: #004721;
        cursor: pointer;
        right: -1350px;
        top: -25px;
    }
    
    .notif-button i {
        position: inherit;
        font-size: 40px;
    }
    
    .wrapper2dash .profile{
        position: relative;
        right: -1200px;
        top: 5px;
        color: white;
    }

    .logo{
        position: absolute;
        justify-content: center;
        width: 1000px;
        height: 100px;
        background-color: whitesmoke;
        border: ridge;
        border-radius: 10px;
        right: 285px;
        top: 75px;
    
    }

    .wrappermenu .Dashboard:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Dashboard:active{
        transform: scale(0.9);
    }


    .wrappermenu .Faculty:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Faculty:active{
        transform: scale(0.9);
    }
    
    .wrappermenu .Addtask:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Addtask:active{
        transform: scale(0.9);
    }
    
    .wrappermenu .Evaluation:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Evaluation:active{
        transform: scale(0.9);
    }
    
    .wrappermenu .Reports:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Reports:active{
        transform: scale(0.9);
    }
    
    .wrappermenu .Request:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Request:active{
        transform: scale(0.9);
    }
    
    .wrappermenu .Logout:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Logout:active{
        transform: scale(0.9);
    }
    .tasklisttable .tasktable{
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-bar {
        position: relative;
        bottom: -120px;
        right: -300px;
        display: flex;
        align-items: center;
    }
    
    .search-bar input {
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    
    .search-bar button {
        padding: 10px 20px;
        background-color: #34c759;
        color: white;
        border: none;
        border-radius: 5px;
        margin-left: 10px;
        cursor: pointer;
    }
    
    .task-list h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }
    
    .task-item {
        position: relative;
        background-color: #fff;
        padding: 15px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        bottom: -175px;
        left: 50px;
        width: 1250px;
    }
    
    .task-item .task-name {
        font-size: 16px;
    }
    
    .task-item .due-date {
        font-size: 14px;
        color: #888;
    }
    
    .edit-task img {
        width: 18px;
        cursor: pointer;
    }

    .task-list{
        position: relative;
        width: 1340px;
        height: 650px;
        background-color: whitesmoke;
        border: ridge;
        border-radius: 10px;
        right: -170px;
        top: -650px;
    }

    .task-list .taskh3{
        position: relative;
        bottom: -150px;
        left: 50px;
    }

    .tasklisttable{
        position: relative;
        width: 1340px;
        height: 650px;
        background-color: whitesmoke;
        border: ridge;
        border-radius: 10px;
        right: -170px;
        top: -650px;
    }

    .tablelist{
        position: relative;
        width: 1340px;
        height: 650px;
        background-color: whitesmoke;
        border: ridge;
        border-radius: 10px;
        right: -170px;
        top: -650px
    }
    
    .sub{
        position: relative;
        right: -170px;
        top: -650px;
        background-color: whitesmoke;
        width: 1340px;
        height: 650px;
        border: ridge;
        border-radius: 10px;
        border: none;
    }
    
    
    
</style>