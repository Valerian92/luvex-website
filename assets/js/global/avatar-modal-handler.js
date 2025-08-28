/**
 * LUVEX Theme - Generic Modal Handler
 * Description: Handles opening and closing of modals triggered by the 'data-modal' attribute.
 * Primarily used for the avatar upload modal.
 * Version: 1.0
 * Last Update: 2025-08-29
 */
document.addEventListener('DOMContentLoaded', function() {
    const modalOverlays = document.querySelectorAll('.modal-overlay');
    const modalTriggers = document.querySelectorAll('[data-modal]');
    const modalCloses = document.querySelectorAll('[data-modal-close]');

    // Open modal when a trigger element is clicked
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('active');
                document.body.classList.add('modal-open'); // Use class for body scroll lock
            }
        });
    });

    // Close modal when a close button is clicked
    modalCloses.forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            const modal = this.closest('.modal-overlay');
            if (modal) {
                modal.classList.remove('active');
                document.body.classList.remove('modal-open');
            }
        });
    });

    // Close modal when the overlay background is clicked
    modalOverlays.forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            // Ensure the click is on the overlay itself, not on its children (the modal content)
            if (e.target === this) {
                this.classList.remove('active');
                document.body.classList.remove('modal-open');
            }
        });
    });

    // Close the currently active modal on 'Escape' key press
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal-overlay.active');
            if (activeModal) {
                activeModal.classList.remove('active');
                document.body.classList.remove('modal-open');
            }
        }
    });
});
