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

function previewAvatarImage(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const avatarContainer = document.querySelector('.current-avatar .header-avatar');
        const saveBtn = document.getElementById('saveAvatarBtn');
        
        if (avatarContainer) {
            avatarContainer.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
        }
        
        // Speichern Button anzeigen
        if (saveBtn) {
            saveBtn.style.display = 'inline-flex';
            saveBtn.onclick = function() { uploadAvatar(file); };
        }
    };
    reader.readAsDataURL(file);
}


// Upload avatar to WordPress
function uploadAvatar(file) {
    const saveBtn = document.getElementById('saveAvatarBtn');
    const formData = new FormData();
    
    // Show loading state
    saveBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Uploading...';
    saveBtn.disabled = true;
    
    formData.append('action', 'luvex_upload_avatar');
    formData.append('avatar_file', file);
    formData.append('nonce', luvex_ajax.nonce);
    
    fetch(luvex_ajax.ajax_url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all avatars on page
            updateAllAvatars(data.data.avatar_url);
            
            // Close modal
            document.querySelector('.modal-overlay.active').classList.remove('active');
            document.body.style.overflow = '';
            
            // Success message
            showNotification('Profile picture updated successfully!', 'success');
        } else {
            showNotification('Upload failed: ' + data.data, 'error');
        }
    })
    .catch(error => {
        showNotification('Upload error: ' + error.message, 'error');
    })
    .finally(() => {
        // Reset button
        saveBtn.innerHTML = '<i class="fa-solid fa-save"></i> Save';
        saveBtn.disabled = false;
        saveBtn.style.display = 'none';
    });
}

// Update all avatar instances on page
function updateAllAvatars(avatarUrl) {
    const avatars = document.querySelectorAll('.user-avatar, .header-avatar, .dropdown-avatar');
    avatars.forEach(avatar => {
        avatar.innerHTML = `<img src="${avatarUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
    });
}

// Simple notification system
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        padding: 1rem 1.5rem; border-radius: 8px; color: white;
        background: ${type === 'success' ? '#10b981' : '#ef4444'};
        transform: translateX(400px); transition: all 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    setTimeout(() => notification.style.transform = 'translateX(0)', 100);
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}