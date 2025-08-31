/**
 * LUVEX THEME - AUTH MODAL LOGIC (v1.1 - Robust)
 *
 * Sucht nach dem Trigger-Button anhand seiner ID und fügt einen Event Listener hinzu.
 * Dies ist die saubere, moderne Methode, die Timing-Probleme vermeidet.
 */
document.addEventListener('DOMContentLoaded', function() {

    const authModal = document.getElementById('authModal');
    const authTrigger = document.getElementById('auth-modal-trigger'); // Button zum Öffnen

    // Beenden, wenn die notwendigen Elemente nicht auf der Seite sind
    if (!authModal || !authTrigger) {
        return;
    }

    const modalContent = authModal.querySelector('.modal-content');
    const feedbackContainer = document.getElementById('auth-feedback');

    /**
     * Öffnet das Modal.
     * @param {string} initialForm - 'login' oder 'register'.
     */
    const openAuthModal = function(initialForm = 'login') {
        document.body.style.overflow = 'hidden';
        authModal.classList.add('active');
        showAuthForm(initialForm);
    };

    /**
     * Schließt das Modal.
     */
    const closeAuthModal = function() {
        document.body.style.overflow = '';
        authModal.classList.remove('active');
    };

    /**
     * Wechselt zwischen den Formularen (Tabs).
     * @param {string} formType - 'login', 'register' oder 'forgot-password'.
     */
    const showAuthForm = function(formType) {
        const forms = modalContent.querySelectorAll('.auth-form-container');
        forms.forEach(form => form.style.display = 'none');

        const tabs = modalContent.querySelectorAll('.auth-tab');
        tabs.forEach(tab => tab.classList.remove('active'));

        const activeForm = document.getElementById(formType + '-form-container');
        const activeTab = document.getElementById(formType + '-tab-link');

        if (activeForm) activeForm.style.display = 'block';
        if (activeTab) activeTab.classList.add('active');
        else document.getElementById('login-tab-link')?.classList.add('active');

        if (feedbackContainer) {
            feedbackContainer.innerHTML = '';
            feedbackContainer.style.display = 'none';
        }
    };
    
    // Globale Funktion für die Tab-Buttons im Modal-HTML
    window.showAuthForm = showAuthForm;

    // --- EVENT LISTENERS ---

    // 1. Klick auf den Haupt-Button im Header
    authTrigger.addEventListener('click', () => {
        openAuthModal('login');
    });

    // 2. Klick auf den Hintergrund zum Schließen
    authModal.addEventListener('click', (event) => {
        if (event.target === authModal) {
            closeAuthModal();
        }
    });

    // 3. Escape-Taste zum Schließen
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && authModal.classList.contains('active')) {
            closeAuthModal();
        }
    });
});

