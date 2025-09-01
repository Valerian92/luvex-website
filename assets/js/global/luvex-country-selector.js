/**
 * LUVEX Interactive Country Selector with Phone Input Sync
 *
 * Description: Steuert eine Länderauswahl, die mit einem Telefon-Eingabefeld
 * synchronisiert ist. Wählt ein Land bei Eingabe der Vorwahl
 * und füllt die Vorwahl bei Auswahl eines Landes aus.
 * Version: 2.0
 */
document.addEventListener('DOMContentLoaded', function() {
    // Finde alle kombinierten Länderauswahl-Gruppen
    const internationalPhoneGroups = document.querySelectorAll('.form-group-phone-international');

    internationalPhoneGroups.forEach(group => {
        const selector = group.querySelector('.luvex-country-selector');
        const phoneInput = group.querySelector('.phone-input');
        
        // Stellt sicher, dass alle notwendigen Elemente vorhanden sind
        if (!selector || !phoneInput) {
            return;
        }

        const trigger = selector.querySelector('.selector-trigger');
        const dropdown = selector.querySelector('.selector-dropdown');
        const searchInput = selector.querySelector('.country-search');
        const optionsList = selector.querySelector('.country-list-options');
        const options = optionsList.querySelectorAll('li');
        const nativeSelect = selector.querySelector('.native-select');
        const selectedDisplay = trigger.querySelector('.selected-country');

        // Lese alle Länderdaten einmalig aus dem DOM für schnellen Zugriff
        const countryData = Array.from(options).map(option => ({
            code: option.dataset.countryCode,
            dialCode: option.dataset.dialCode,
            name: option.querySelector('.name').textContent,
            flag: option.querySelector('.flag').textContent,
            element: option
        }));

        // Funktion zum Öffnen/Schließen des Dropdowns
        function toggleDropdown(event) {
            event.stopPropagation();
            selector.classList.toggle('open');
            if (selector.classList.contains('open')) {
                searchInput.focus();
            }
        }
        
        function closeDropdown() {
            selector.classList.remove('open');
        }

        // Funktion, um den Selector basierend auf einem Ländercode zu aktualisieren
        function updateSelectorDisplay(countryCode) {
            const country = countryData.find(c => c.code === countryCode);
            if (!country) return;

            // Aktualisiere die Anzeige im Trigger-Button
            selectedDisplay.querySelector('.flag').textContent = country.flag;
            selectedDisplay.querySelector('.name').textContent = country.name;

            // Aktualisiere das native Select-Feld
            if (nativeSelect.value !== country.code) {
                nativeSelect.value = country.code;
                nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }

        // Funktion, die eine Auswahl durch den Nutzer verarbeitet
        function handleOptionSelection(option) {
            const countryCode = option.dataset.countryCode;
            const dialCode = option.dataset.dialCode;

            updateSelectorDisplay(countryCode);

            // Ersetze oder setze die Vorwahl im Telefon-Eingabefeld
            const currentPhoneValue = phoneInput.value;
            let newPhoneValue = dialCode + ' ';

            // Finde die alte Vorwahl und ersetze sie, falls vorhanden
            const oldDialCode = countryData.find(c => currentPhoneValue.startsWith(c.dialCode + ' '));
            if (oldDialCode) {
                const numberPart = currentPhoneValue.substring(oldDialCode.dialCode.length).trim();
                newPhoneValue = dialCode + ' ' + numberPart;
            }
            
            phoneInput.value = newPhoneValue;
            phoneInput.focus();
            closeDropdown();
        }

        // --- Event Listener ---

        trigger.addEventListener('click', toggleDropdown);

        options.forEach(option => {
            option.addEventListener('click', () => handleOptionSelection(option));
            option.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    handleOptionSelection(option);
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

        // Event Listener für das Telefon-Eingabefeld
        phoneInput.addEventListener('input', () => {
            const inputValue = phoneInput.value;
            
            // Finde die längste passende Vorwahl
            let bestMatch = null;
            for (const country of countryData) {
                if (inputValue.startsWith(country.dialCode)) {
                    if (!bestMatch || country.dialCode.length > bestMatch.dialCode.length) {
                        bestMatch = country;
                    }
                }
            }
            
            if (bestMatch) {
                updateSelectorDisplay(bestMatch.code);
            }
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
