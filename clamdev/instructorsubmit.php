<?php
// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "clam";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks from the database
$tasks = [];
$sql = "SELECT * FROM task"; // Assuming tasks table
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
} else {
    echo "No tasks found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructo Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper2dash">
        <div>
            <input class="input-search" type="text" placeholder="Search">
        </div>

        <p class="profile">Lead Instructor</p>
        <button class="notif-button" type="button"><i class='bx bxs-envelope' ></i></button>

    </div> 

    <div class="wrappermenu">
        <a href="instructorDashboard.html">
            <button class="Dashboard" type="button"><i class='bx bx-doughnut-chart'></i>Dashboard</button>
        </a>
        <a href="instructorsubmit.html">
            <button class="Faculty" type="menu"><i class='bx bx-group'></i>Task</button>
        </a>
    </div>

    <div class="wrappersubmit">
        <h2>Task Submission</h2>
        
        <!-- Loop through the tasks and display them in a table -->
        <table>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Due Date</th>
                    <th>Upload File</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['TaskDescription']) ?></td>
                        <td><?= htmlspecialchars($task['TaskDueDate']) ?></td>
                        <td>
                            <!-- File upload form for each task -->
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="TaskID" value="<?= $task['id'] ?>">
                                <input type="file" name="file" id="taskupload" accept="application/pdf">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No tasks available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- File Upload Handling -->
    <div>
        <button type="button" id="customfilebutton">Choose File</button>
        <span id="filename">No File Chosen</span>
    </div>

    <script>
        const realFile = document.getElementById('taskupload');
        const customFile = document.getElementById('customfilebutton');
        const fileName = document.getElementById('filename');

        customFile.addEventListener('click', () => {
            realFile.click();
        });

        realFile.addEventListener('change', () => {
            if(realFile.value) {
                fileName.innerHTML = realFile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else {
                fileName.innerHTML = 'No File Chosen';
            }
        });
    </script>
</body>

</html>


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
        transition: ease-out 0.5s;
    }
    
    .wrappermenu .Faculty{
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
    
    .Faculty i {
        position: relative;
        right: 10px;
        font-size: 15px;
    }
    .Dashboard i {
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
        top: -60px;
    }
    
    .notif-button i {
        position: inherit;
        font-size: 40px;
    }
    
    .wrapper2dash .profile{
        position: relative;
        right: -1225px;
        top: -10px;
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
    
    .wrappermenu .Logout:hover{
        color: white;
        box-shadow: inset 0 -100px 0 0 #009c4a;
    }
    
    .wrappermenu .Logout:active{
        transform: scale(0.9);
    }

    .wrappersubmit{
        position: relative;
        width: 1340px;
        height: 650px;
        background-color: whitesmoke;
        border: ridge;
        border-radius: 10px;
        right: -170px;
        top: -650px;
    }

    table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }


</style>