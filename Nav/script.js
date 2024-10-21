window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bx-search")

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    searchBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}


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