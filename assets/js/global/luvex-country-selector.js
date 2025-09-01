/**
 * LUVEX Form-Ready Country Selector & Phone Sync
 *
 * Description: Steuert eine für Formulare optimierte, durchsuchbare Länderauswahl,
 * die mit separaten Telefon-Vorwahl- und Nummernfeldern synchronisiert ist.
 * Version: 3.0
 */
document.addEventListener('DOMContentLoaded', function() {
    const selectorElement = document.getElementById('luvex-country-selector');
    if (!selectorElement) return;

    const countryInput = selectorElement.querySelector('.country-selector-input');
    const dropdown = selectorElement.querySelector('.selector-dropdown');
    const searchInput = selectorElement.querySelector('.country-search');
    const optionsList = selectorElement.querySelector('.country-list-options');
    const options = optionsList.querySelectorAll('li');
    const nativeSelect = selectorElement.querySelector('.native-select');
    const flagDisplay = selectorElement.querySelector('.selected-country-flag');
    
    const dialCodeInput = document.getElementById('phone-input-dial-code');
    const mobileInput = document.getElementById('phone-input-mobile');

    let userModifiedDialCode = false;

    // Lese alle Länderdaten einmalig aus dem DOM für schnellen Zugriff
    const countryData = Array.from(options).map(option => ({
        code: option.dataset.countryCode,
        dialCode: option.dataset.dialCode,
        name: option.querySelector('.name').textContent,
        flag: option.querySelector('.flag').textContent,
        element: option
    }));

    function openDropdown() {
        selectorElement.classList.add('open');
        searchInput.value = '';
        filterOptions('');
        searchInput.focus();
    }
    
    function closeDropdown() {
        selectorElement.classList.remove('open');
    }

    function filterOptions(searchTerm) {
        const term = searchTerm.toLowerCase();
        options.forEach(option => {
            const name = option.querySelector('.name').textContent.toLowerCase();
            const dialCode = option.querySelector('.dial-code').textContent.toLowerCase();
            const isVisible = name.includes(term) || dialCode.includes(term);
            option.classList.toggle('hidden', !isVisible);
        });
    }

    function updateCountrySelection(country, source = 'user') {
        if (!country) {
            countryInput.value = '';
            flagDisplay.textContent = '';
            nativeSelect.value = '';
            return;
        }

        countryInput.value = country.name;
        flagDisplay.textContent = country.flag;
        if (nativeSelect.value !== country.code) {
            nativeSelect.value = country.code;
            nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Update dial code only if not manually changed by user or if selected via country list
        if (!userModifiedDialCode || source === 'country_selection') {
            dialCodeInput.value = country.dialCode;
            userModifiedDialCode = false; // Reset flag after a country selection
        }
    }

    // --- EVENT LISTENERS ---

    // Open dropdown when clicking the main country input
    countryInput.addEventListener('click', (e) => {
        e.stopPropagation();
        if (selectorElement.classList.contains('open')) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });
    
    // Prevent typing in the main input, it's just a trigger
    countryInput.addEventListener('keydown', (e) => e.preventDefault());

    // Filter list on search input
    searchInput.addEventListener('input', () => filterOptions(searchInput.value));

    // Handle country selection from the list
    options.forEach(option => {
        option.addEventListener('click', () => {
            const countryCode = option.dataset.countryCode;
            const selectedCountry = countryData.find(c => c.code === countryCode);
            updateCountrySelection(selectedCountry, 'country_selection');
            closeDropdown();
            mobileInput.focus();
        });
    });

    // Update country based on dial code input
    dialCodeInput.addEventListener('input', () => {
        userModifiedDialCode = true; // Mark as user-edited
        const inputValue = dialCodeInput.value;
        
        let bestMatch = null;
        if (inputValue.length > 1) {
             for (const country of countryData) {
                if (inputValue === country.dialCode) { // Find exact match first
                    bestMatch = country;
                    break;
                }
                if (country.dialCode.startsWith(inputValue)) { // Find partial match
                     if (!bestMatch) bestMatch = country;
                }
            }
        }
        updateCountrySelection(bestMatch, 'dial_code_input');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!selectorElement.contains(e.target)) {
            closeDropdown();
        }
    });

    // Close with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && selectorElement.classList.contains('open')) {
            closeDropdown();
        }
    });
});

