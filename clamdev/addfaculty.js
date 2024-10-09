document.addEventListener("DOMContentLoaded", () => {
    const addFacultyBtn = document.getElementById('addFacultyBtn');
    const modal = document.getElementById('myModal');
    const closeModal = document.querySelector('.close');
    const submitBtn = document.querySelector('.submit');
    
    // Open Modal on Add Faculty Button Click
    addFacultyBtn.addEventListener('click', () => {
        modal.style.display = "block";
    });
    
    // Close Modal on 'X' Click
    closeModal.addEventListener('click', () => {
        modal.style.display = "none";
    });
    
    // Close Modal on Window Click
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
    
    // Add Faculty on Submit Click
    submitBtn.addEventListener('click', () => {
        const departmentName = document.getElementById('departmentName').value;
        
        if (departmentName.trim() === "") {
            alert("Please enter a valid department name.");
            return;
        }
        
        // Create a new element to represent the new faculty (for example, in a list or table)
        const facultyList = document.querySelector('.wrapperfaculty'); // Assuming this is where the list is
        const newFaculty = document.createElement('div');
        newFaculty.classList.add('faculty-item'); // Add a class for styling
        
        // Populate the new faculty entry
        newFaculty.innerHTML = `
            <p>Department: ${departmentName}</p>
        `;
        
        // Append the new faculty to the list
        facultyList.appendChild(newFaculty);
        
        // Clear the input field and close the modal
        document.getElementById('departmentName').value = "";
        modal.style.display = "none";
    });
});
