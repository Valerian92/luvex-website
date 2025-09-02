/**
 * LUVEX Form-Ready Country Selector & Phone Sync
 *
 * Description: Steuert eine für Formulare optimierte, durchsuchbare Länderauswahl,
 * die mit separaten Telefon-Vorwahl- und Nummernfeldern synchronisiert ist.
 * Version: 5.5 (Final Logic)
 */
document.addEventListener('DOMContentLoaded', function() {
    const selectorElement = document.getElementById('luvex-country-selector');
    if (!selectorElement) return;

    // --- DOM Element Selection ---
    const countryInput = selectorElement.querySelector('.country-selector-input');
    const dropdown = selectorElement.querySelector('.selector-dropdown');
    const searchInput = selectorElement.querySelector('.country-search');
    const optionsList = selectorElement.querySelector('.country-list-options');
    const options = optionsList.querySelectorAll('li');
    const nativeSelect = selectorElement.querySelector('.native-select');
    const flagDisplay = selectorElement.querySelector('.selected-country-flag');
    
    const dialCodeInput = document.getElementById('phone-input-dial-code');
    const mobileInput = document.getElementById('phone-input-mobile');
    const dialCodeFlag = document.querySelector('.phone-dial-code-flag');

    if (!countryInput || !dropdown || !searchInput || !optionsList || !nativeSelect || !flagDisplay || !dialCodeInput || !mobileInput || !dialCodeFlag) {
        console.error('LUVEX Country Selector: A required element is missing. Please ensure HTML structure is up to date.');
        return;
    }

    let userModifiedDialCode = false;

    // --- Data Initialization ---
    const countryData = Array.from(options).map(option => ({
        code: option.dataset.countryCode,
        dialCode: option.dataset.dialCode,
        name: option.querySelector('.name').textContent,
        flag: option.querySelector('.flag').textContent
    }));

    // --- Core Functions ---
    const toggleDropdown = (forceState) => {
        const isOpen = selectorElement.classList.contains('open');
        const action = forceState !== undefined ? forceState : (isOpen ? 'close' : 'open');
        
        if (action === 'open' && !isOpen) {
            selectorElement.classList.add('open');
            searchInput.value = '';
            filterOptions('');
            searchInput.focus();
        } else if (action === 'close' && isOpen) {
            selectorElement.classList.remove('open');
        }
    };

    const filterOptions = (searchTerm) => {
        const term = searchTerm.toLowerCase().trim();
        options.forEach(option => {
            const name = option.querySelector('.name').textContent.toLowerCase();
            const dial = option.querySelector('.dial-code').textContent;
            const isVisible = name.includes(term) || dial.includes(term);
            option.classList.toggle('hidden', !isVisible);
        });
    };

    const updateUI = (country, source = 'system') => {
        if (!country) {
            countryInput.value = '';
            flagDisplay.textContent = ' ';
            nativeSelect.value = '';
            if (source !== 'dial_code_input' && !userModifiedDialCode) {
                 dialCodeInput.value = '';
                 dialCodeFlag.textContent = ' ';
            }
            return;
        }

        // Always update the country selection part of the UI
        countryInput.value = country.name;
        flagDisplay.textContent = country.flag;
        if (nativeSelect.value !== country.code) {
            nativeSelect.value = country.code;
            nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Only update the phone dial code UI if the user has NOT manually modified it
        if (!userModifiedDialCode) {
            dialCodeInput.value = country.dialCode;
            dialCodeFlag.textContent = country.flag;
        }
    };
    
    const findCountryByDialCode = (dialCode) => {
        const cleanDialCode = dialCode.trim();
        if (!cleanDialCode) return null;
        
        let bestMatch = null;
        for (const country of countryData) {
            if (cleanDialCode.startsWith(country.dialCode)) {
                if (!bestMatch || country.dialCode.length > bestMatch.dialCode.length) {
                    bestMatch = country;
                }
            }
        }
        return bestMatch;
    };

    // --- Event Listeners ---
    selectorElement.querySelector('.selector-input-wrapper').addEventListener('click', (e) => {
        e.stopPropagation();
        toggleDropdown();
    });
    
    searchInput.addEventListener('input', () => filterOptions(searchInput.value));

    optionsList.addEventListener('click', (e) => {
        const option = e.target.closest('li');
        if (option) {
            const countryCode = option.dataset.countryCode;
            const selectedCountry = countryData.find(c => c.code === countryCode);
            updateUI(selectedCountry, 'country_selection');
            toggleDropdown('close');
            mobileInput.focus();
        }
    });

    dialCodeInput.addEventListener('input', () => {
        userModifiedDialCode = true; // User has taken control. Protect this field.
        const country = findCountryByDialCode(dialCodeInput.value);

        // Instantly update the flag next to the dial code
        if (country) {
            dialCodeFlag.textContent = country.flag;
        } else {
            dialCodeFlag.textContent = ' ';
        }

        // Backwards sync: Only update the country selector IF it was empty.
        if (!countryInput.value.trim()) {
            if (country) {
                // Directly update country UI without calling updateUI to prevent loops
                countryInput.value = country.name;
                flagDisplay.textContent = country.flag;
                if (nativeSelect.value !== country.code) {
                    nativeSelect.value = country.code;
                    nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                }
            } else {
                 countryInput.value = '';
                 flagDisplay.textContent = ' ';
                 nativeSelect.value = '';
            }
        }
    });

    document.addEventListener('click', (e) => {
        if (!selectorElement.contains(e.target)) {
            toggleDropdown('close');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && selectorElement.classList.contains('open')) {
            toggleDropdown('close');
        }
    });

    // --- Initial State from PHP ---
    const initialCountryCode = nativeSelect.value;
    if(initialCountryCode) {
        const initialCountry = countryData.find(c => c.code === initialCountryCode);
        if (initialCountry) {
            updateUI(initialCountry, 'initial');
        }
    }
});


