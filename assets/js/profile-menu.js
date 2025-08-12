document.addEventListener('DOMContentLoaded', function() {
    // Dropdown Funktionalität (bestehend)
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

    // NEU: Avatar upload preview
    const avatarInput = document.getElementById('avatarFileInput');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                previewAvatarImage(file);
            }
        });
    }
});

// NEU: Preview Funktion
function previewAvatarImage(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const avatarContainer = document.querySelector('.current-avatar .header-avatar');
        if (avatarContainer) {
            avatarContainer.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
        }
    };
    reader.readAsDataURL(file);
}