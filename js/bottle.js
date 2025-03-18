// Main JavaScript file for general functionality

document.addEventListener('DOMContentLoaded', function() {
       
    // User dropdown functionality
    const userDropdown = document.querySelector('.user-dropdown');
    const userDropdownToggle = userDropdown.querySelector('.dropdown-toggle');
    
    userDropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        userDropdown.classList.toggle('active');
    });
    
    // Close user dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (userDropdown.classList.contains('active') && 
            !  function(e) {
        if (userDropdown.classList.contains('active') && 
            !userDropdown.contains(e.target) && 
            e.target !== userDropdownToggle && 
            !userDropdownToggle.contains(e.target)) {
            userDropdown.classList.remove('active');
        }
    });
});
});