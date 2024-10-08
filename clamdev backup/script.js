const realFile = document.getElementById('taskupload');
const customFile = document.getElementById('taskfileupload');
const fileName = document.getElementById('filename');

customFile.addEventListener('click', () => {
  realFile.click();
});

realFile.addEventListener('change', () => {
  if(realFile.value){
    fileName.innerHTML = realFile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
  }
  else{
    fileName.innerHTML = 'No File Choosen';
  }
})

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("createButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
