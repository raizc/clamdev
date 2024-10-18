<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

 
 <!--========= Navigation ===================-->

  <body>
      <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">CLAMDEV</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorDashboard.html')">
                        <span class="icon"><ion-icon name="aperture-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorDept.html')">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Departments</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorAddTask.html')">
                        <span class="icon"><ion-icon name="archive-outline"></ion-icon>
                        </span>
                        <span class="title">Add Task</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorEvaluation.html')">
                        <span class="icon"><ion-icon name="star-outline"></ion-icon>
                        </span>
                        <span class="title">Evaluation</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorReports.html')">
                        <span class="icon"><ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Reports</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="loadContent('DirectorCalerdar.html')">
                        <span class="icon"><ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="/index.html">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    
                    </a>
                </li>
            </ul>
        </div>
      </div> 
<!--================== Main ===================-->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
</div>



   <!--========== Icon ===========-->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    </body>
</html>

<script>


function loadContent(page) {
    var xhttp = new XMLHttpRequest();
    
    // Define a callback function
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Replace the content with the response
            document.getElementById("content").innerHTML = this.responseText;
        }
    };

    // Send a request to the server
    xhttp.open("GET", page, true);
    xhttp.send();
}

// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));


    let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
</script>