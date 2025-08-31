/**
 * LUVEX THEME - AUTH MODAL LOGIC (v1.0)
 *
 * Stellt die globale Funktion openAuthModal() bereit, die vom Login-Button im Header
 * aufgerufen wird. Steuert das Öffnen, Schließen und die Tab-Navigation des Modals.
 * Dies ist der saubere Ersatz für die alte, generische Modal-Logik.
 */
document.addEventListener('DOMContentLoaded', function() {

    const authModal = document.getElementById('authModal');
    if (!authModal) {
        // Wenn das Modal nicht auf der Seite ist, wird nichts ausgeführt.
        return;
    }

    const modalContent = authModal.querySelector('.modal-content');
    const feedbackContainer = document.getElementById('auth-feedback');

    /**
     * Globale Funktion zum Öffnen des Modals.
     * Wird direkt vom `onclick`-Attribut im Button der header.php aufgerufen.
     * @param {string} initialForm - 'login' oder 'register', um den Start-Tab festzulegen.
     */
    window.openAuthModal = function(initialForm = 'login') {
        // Verhindert das Scrollen der Seite im Hintergrund
        document.body.style.overflow = 'hidden';
        // Macht das Modal sichtbar
        authModal.classList.add('active');
        // Zeigt das richtige Formular (Login oder Register) an
        showAuthForm(initialForm);
    };

    /**
     * Schließt das Modal und stellt das Scrollen der Seite wieder her.
     */
    window.closeAuthModal = function() {
        document.body.style.overflow = '';
        authModal.classList.remove('active');
    };

    /**
     * Wechselt zwischen den Formularen (Tabs) innerhalb des Modals.
     * @param {string} formType - 'login', 'register' oder 'forgot-password'.
     */
    window.showAuthForm = function(formType) {
        // Alle Formulare ausblenden
        const forms = modalContent.querySelectorAll('.auth-form-container');
        forms.forEach(form => form.style.display = 'none');

        // Alle Tabs als inaktiv markieren
        const tabs = modalContent.querySelectorAll('.auth-tab');
        tabs.forEach(tab => tab.classList.remove('active'));

        // Das gewünschte Formular und den zugehörigen Tab anzeigen
        const activeForm = document.getElementById(formType + '-form-container');
        const activeTab = document.getElementById(formType + '-tab-link');

        if (activeForm) {
            activeForm.style.display = 'block';
        }

        if (activeTab) {
            activeTab.classList.add('active');
        } else {
            // Wenn es keinen Tab gibt (z.B. für "Forgot Password"), den Login-Tab aktiv lassen
            document.getElementById('login-tab-link')?.classList.add('active');
        }

        // Eventuelle Feedback-Nachrichten zurücksetzen
        if (feedbackContainer) {
            feedbackContainer.innerHTML = '';
            feedbackContainer.style.display = 'none';
        }
    };

    // Event Listener zum Schließen des Modals
    // 1. Klick auf das Overlay (den dunklen Hintergrund)
    authModal.addEventListener('click', function(event) {
        if (event.target === authModal) {
            closeAuthModal();
        }
    });

    // 2. Drücken der Escape-Taste
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && authModal.classList.contains('active')) {
            closeAuthModal();
        }
    });
});
