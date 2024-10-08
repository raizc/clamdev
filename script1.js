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
</script>