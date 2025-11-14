/**
 * LUVEX Profile Menu & Language System - Frontend Logic (FIXED)
 * Enhanced with Language Switching Capabilities
 * 
 * @since 3.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    
    /**
     * ========================================================================
     * USER DROPDOWN FUNCTIONALITY
     * ========================================================================
     */
    
    // Toggle user dropdown
    window.toggleUserDropdown = function() {
        const dropdown = document.getElementById('userDropdown');
        const languageDropdown = document.getElementById('languageDropdown');
        
        if (dropdown) {
            const isVisible = dropdown.classList.contains('visible');
            
            // Close other dropdowns
            if (languageDropdown) {
                languageDropdown.classList.remove('visible');
                languageDropdown.classList.remove('show');
            }
            
            dropdown.classList.toggle('visible');
            dropdown.classList.toggle('show');
            
            // Add ARIA attributes for accessibility
            dropdown.setAttribute('aria-hidden', isVisible ? 'true' : 'false');
        }
    };
    
    // NEW: Toggle language dropdown (unified function)
    window.toggleLanguageDropdown = function() {
        const dropdown = document.getElementById('languageDropdown');
        const userDropdown = document.getElementById('userDropdown');
        const trigger = document.querySelector('.language-switcher-trigger');
        
        if (dropdown) {
            const isVisible = dropdown.classList.contains('visible') || dropdown.classList.contains('show');
            
            // Close user dropdown if open
            if (userDropdown) {
                userDropdown.classList.remove('visible');
                userDropdown.classList.remove('show');
            }
            
            // Toggle language dropdown
            dropdown.classList.toggle('visible');
            dropdown.classList.toggle('show');
            dropdown.setAttribute('aria-hidden', isVisible ? 'true' : 'false');
            
            // Toggle trigger visual state
            if (trigger) {
                trigger.classList.toggle('open');
            }
        }
    };
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const userSection = document.querySelector('.user-section');
        const languageSection = document.querySelector('.language-switcher-dropdown');
        const userDropdown = document.getElementById('userDropdown');
        const languageDropdown = document.getElementById('languageDropdown');
        const languageTrigger = document.querySelector('.language-switcher-trigger');
       
        // Close user dropdown if clicking outside
        if (userSection && !userSection.contains(event.target)) {
            if (userDropdown) {
                userDropdown.classList.remove('visible');
                userDropdown.classList.remove('show');
            }
        }
        
        // Close language dropdown if clicking outside
        if (languageSection && !languageSection.contains(event.target)) {
            if (languageDropdown) {
                languageDropdown.classList.remove('visible');
                languageDropdown.classList.remove('show');
            }
            if (languageTrigger) {
                languageTrigger.classList.remove('open');
            }
        }
    });

    /**
     * ========================================================================
     * LANGUAGE SWITCHING SYSTEM
     * ========================================================================
     */
    
    // Language switching for logged-in users
    window.switchLanguage = function(languageCode) {
        if (!languageCode) {
            console.error('Language code is required');
            return;
        }
        
        // Validate language data is available
        if (typeof luvexLanguage === 'undefined') {
            console.error('Language system not initialized');
            return;
        }
        
        // Show loading state
        const button = document.querySelector(`[data-language="${languageCode}"]`);
        const originalContent = button ? button.innerHTML : '';
        
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Switching...';
        }
        
        // Send AJAX request to update language preference
        const formData = new FormData();
        formData.append('action', 'luvex_set_language');
        formData.append('language', languageCode);
        formData.append('nonce', luvexLanguage.nonce);
        
        fetch(luvexLanguage.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success: redirect to translated page
                console.log('Language updated:', languageCode);
                
                if (data.data.redirect_url) {
                    window.location.href = data.data.redirect_url;
                } else {
                    // Fallback: reload current page
                    window.location.reload();
                }
            } else {
                console.error('Language switch failed:', data.data);
                showNotification('Failed to switch language: ' + data.data, 'error');
                
                // Reset button state
                if (button) {
                    button.disabled = false;
                    button.innerHTML = originalContent;
                }
            }
        })
        .catch(error => {
            console.error('Language switch error:', error);
            showNotification('Network error: Could not switch language', 'error');
            
            // Reset button state
            if (button) {
                button.disabled = false;
                button.innerHTML = originalContent;
            }
        });
    };
    
    // Language switching for guests (cookie-based)
    window.switchLanguageGuest = function(languageCode) {
        if (!languageCode) {
            console.error('Language code is required');
            return;
        }
        
        // Show loading state
        const button = document.querySelector(`[data-language="${languageCode}"]`);
        const originalContent = button ? button.innerHTML : '';
        
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Switching...';
        }
        
        // For guests, we still use AJAX to set cookie and get redirect URL
        const formData = new FormData();
        formData.append('action', 'luvex_set_language');
        formData.append('language', languageCode);
        formData.append('nonce', luvexLanguage?.nonce || '');
        
        // First, set cookie directly for immediate effect
        setCookie('luvex_preferred_language', languageCode, 30);
        
        // Then get proper redirect URL from server
        if (typeof luvexLanguage !== 'undefined' && luvexLanguage.ajax_url) {
            fetch(luvexLanguage.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data.redirect_url) {
                    window.location.href = data.data.redirect_url;
                } else {
                    window.location.reload();
                }
            })
            .catch(() => {
                // Fallback: simple reload
                window.location.reload();
            });
        } else {
            // Simple fallback without AJAX
            window.location.reload();
        }
    };

    /**
     * ========================================================================
     * AVATAR UPLOAD SYSTEM
     * ========================================================================
     */
    
    const avatarInput = document.getElementById('avatarFileInput');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                previewAvatarImage(file);
            }
        });
    }
    
    // Avatar preview with enhanced validation
    window.previewAvatarImage = function(file) {
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            showNotification('Invalid file type. Please use JPG, PNG, GIF, or WebP.', 'error');
            return;
        }
        
        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            showNotification('File too large. Maximum size is 5MB.', 'error');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatarContainer = document.querySelector('.current-avatar .header-avatar');
            const saveBtn = document.getElementById('saveAvatarBtn');
            
            if (avatarContainer) {
                avatarContainer.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Avatar Preview">`;
            }
            
            // Show save button
            if (saveBtn) {
                saveBtn.style.display = 'inline-flex';
                saveBtn.onclick = function() { uploadAvatar(file); };
            }
        };
        reader.readAsDataURL(file);
    };

    // Upload avatar to WordPress with enhanced error handling
    window.uploadAvatar = function(file) {
        const saveBtn = document.getElementById('saveAvatarBtn');
        
        if (!saveBtn) {
            console.error('Save button not found');
            return;
        }
        
        // Check if AJAX data is available
        if (typeof luvex_ajax === 'undefined') {
            showNotification('Upload system not initialized', 'error');
            return;
        }
        
        // Show loading state
        saveBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Uploading...';
        saveBtn.disabled = true;
        
        const formData = new FormData();
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
                const activeModal = document.querySelector('.modal-overlay.active');
                if (activeModal) {
                    activeModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                // Success message
                showNotification('Profile picture updated successfully!', 'success');
            } else {
                showNotification('Upload failed: ' + data.data, 'error');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            showNotification('Upload error: ' + error.message, 'error');
        })
        .finally(() => {
            // Reset button
            saveBtn.innerHTML = '<i class="fa-solid fa-save"></i> Save';
            saveBtn.disabled = false;
            saveBtn.style.display = 'none';
        });
    };

    /**
     * ========================================================================
     * UTILITY FUNCTIONS
     * ========================================================================
     */
    
    // Update all avatar instances on page
    function updateAllAvatars(avatarUrl) {
        const avatars = document.querySelectorAll('.user-avatar, .header-avatar, .dropdown-avatar');
        avatars.forEach(avatar => {
            avatar.innerHTML = `<img src="${avatarUrl}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="User Avatar">`;
        });
    }

    // Enhanced notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.luvex-notification');
        existingNotifications.forEach(n => n.remove());
        
        const notification = document.createElement('div');
        notification.className = `luvex-notification luvex-notification--${type}`;
        
        // Notification content
        const icon = type === 'success' ? 'fa-check-circle' : 
                    type === 'error' ? 'fa-exclamation-circle' : 
                    'fa-info-circle';
        
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fa-solid ${icon}"></i>
                <span>${message}</span>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="fa-solid fa-times"></i>
            </button>
        `;
        
        // Styling
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 500px;
            padding: 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
            transform: translateX(100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        `;
        
        // Add to DOM
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
    
    // Cookie utility functions
    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
    }
    
    function getCookie(name) {
        return document.cookie.split('; ').reduce((r, v) => {
            const parts = v.split('=');
            return parts[0] === name ? decodeURIComponent(parts[1]) : r;
        }, '');
    }

    /**
     * ========================================================================
     * KEYBOARD ACCESSIBILITY
     * ========================================================================
     */
    
    // Handle keyboard navigation for dropdowns
    document.addEventListener('keydown', function(e) {
        // ESC key closes all dropdowns
        if (e.key === 'Escape') {
            document.getElementById('userDropdown')?.classList.remove('visible', 'show');
            document.getElementById('languageDropdown')?.classList.remove('visible', 'show');
            document.querySelector('.language-switcher-trigger')?.classList.remove('open');
        }
        
        // Enter/Space on language buttons
        if ((e.key === 'Enter' || e.key === ' ') && e.target.classList.contains('language-option')) {
            e.preventDefault();
            const languageCode = e.target.getAttribute('data-language');
            if (languageCode && !e.target.disabled) {
                const isLoggedIn = typeof luvexLanguage !== 'undefined' && luvexLanguage.user_logged_in;
                if (isLoggedIn) {
                    switchLanguage(languageCode);
                } else {
                    switchLanguageGuest(languageCode);
                }
            }
        }
    });

    /**
     * ========================================================================
     * INITIALIZATION & DEBUG
     * ========================================================================
     */
    
    // Initialize language system if data is available
    if (typeof luvexLanguage !== 'undefined') {
        console.log('🌍 LUVEX Language System initialized');
        console.log('Current language:', luvexLanguage.current_language);
        console.log('Supported languages:', Object.keys(luvexLanguage.supported_languages));
        
        // Update UI with current language
        updateLanguageUI();
    }
    
    // Update language UI elements
    function updateLanguageUI() {
        if (typeof luvexLanguage === 'undefined') return;
        
        const currentLang = luvexLanguage.current_language;
        const langData = luvexLanguage.supported_languages[currentLang];
        
        if (!langData) return;
        
        // Update compact language switcher
        const compactSwitcher = document.querySelector('.language-switcher-trigger');
        if (compactSwitcher) {
            const flag = compactSwitcher.querySelector('.language-flag');
            const code = compactSwitcher.querySelector('.language-code');
            
            if (flag) flag.textContent = langData.flag;
            if (code) code.textContent = currentLang.toUpperCase();
        }
    }
    
    // Export functions globally for template usage
    window.LuvexLanguageSystem = {
        switchLanguage,
        switchLanguageGuest,
        setCookie,
        getCookie,
        showNotification
    };
});

/**
 * ========================================================================
 * CSS-IN-JS STYLES (FOR NOTIFICATION SYSTEM)
 * ========================================================================
 */

// Add notification styles if not already present
if (!document.querySelector('#luvex-notification-styles')) {
    const notificationStyles = document.createElement('style');
    notificationStyles.id = 'luvex-notification-styles';
    notificationStyles.textContent = `
        .luvex-notification {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            border-left: 4px solid rgba(255,255,255,0.5);
        }
        
        .notification-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .notification-content i {
            font-size: 1.1rem;
        }
        
        .notification-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .notification-close:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        @media (max-width: 640px) {
            .luvex-notification {
                left: 10px;
                right: 10px;
                min-width: auto;
                transform: translateY(-100%);
            }
            
            .luvex-notification.show {
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(notificationStyles);
}