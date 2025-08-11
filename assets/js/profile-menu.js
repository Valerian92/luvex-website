document.addEventListener('DOMContentLoaded', function() {
    window.toggleUserDropdown = function() {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) {
            dropdown.classList.toggle('visible');
        }
    };

    document.addEventListener('click', function(event) {
        const userSection = document.querySelector('.user-section');
        const dropdown = document.getElementById('userDropdown');
        
        if (userSection && !userSection.contains(event.target)) {
            dropdown?.classList.remove('visible');
        }
    });
});