/**
 * LUVEX Interactive Country Selector
 *
 * Description: Steuert die Funktionalität der benutzerdefinierten Länderauswahl-Komponente.
 * Version: 1.0
 */
document.addEventListener('DOMContentLoaded', function() {
    // Finde alle Country-Selector-Komponenten auf der Seite
    const selectors = document.querySelectorAll('.luvex-country-selector');

    selectors.forEach(selector => {
        const trigger = selector.querySelector('.selector-trigger');
        const dropdown = selector.querySelector('.selector-dropdown');
        const searchInput = selector.querySelector('.country-search');
        const optionsList = selector.querySelector('.country-list-options');
        const options = optionsList.querySelectorAll('li');
        const nativeSelect = selector.querySelector('.native-select');
        const selectedDisplay = trigger.querySelector('.selected-country');

        // Funktion zum Öffnen/Schließen des Dropdowns
        function toggleDropdown() {
            selector.classList.toggle('open');
        }

        // Funktion zum Schließen des Dropdowns
        function closeDropdown() {
            selector.classList.remove('open');
        }

        // Event Listener für den Trigger-Button
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown();
        });

        // Event Listener für die Auswahl einer Option
        options.forEach(option => {
            function selectOption() {
                const countryCode = option.dataset.countryCode;

                // Aktualisiere das native Select-Feld (wichtig für Forms)
                nativeSelect.value = countryCode;

                // Aktualisiere die Anzeige im Trigger-Button
                const flag = option.querySelector('.flag').textContent;
                const name = option.querySelector('.name').textContent;
                const dialCode = option.querySelector('.dial-code').textContent;

                selectedDisplay.querySelector('.flag').textContent = flag;
                selectedDisplay.querySelector('.name').textContent = name;
                selectedDisplay.querySelector('.dial-code').textContent = dialCode;
                
                // Schließe das Dropdown
                closeDropdown();
                
                // Optional: Einen Event auslösen, falls andere Skripte darauf reagieren müssen
                nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }
            
            option.addEventListener('click', selectOption);
            option.addEventListener('keydown', (e) => {
                 if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    selectOption();
                 }
            });
        });

        // Event Listener für die Live-Suche
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            options.forEach(option => {
                const name = option.querySelector('.name').textContent.toLowerCase();
                const dialCode = option.querySelector('.dial-code').textContent.toLowerCase();
                if (name.includes(searchTerm) || dialCode.includes(searchTerm)) {
                    option.classList.remove('hidden');
                } else {
                    option.classList.add('hidden');
                }
            });
        });

        // Schließe das Dropdown, wenn außerhalb geklickt wird
        document.addEventListener('click', (e) => {
            if (!selector.contains(e.target)) {
                closeDropdown();
            }
        });
        
        // Schließe das Dropdown mit der Escape-Taste
        document.addEventListener('keydown', (e) => {
             if (e.key === 'Escape' && selector.classList.contains('open')) {
                closeDropdown();
             }
        });
    });
});
