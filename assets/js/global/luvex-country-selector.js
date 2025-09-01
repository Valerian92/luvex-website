/**
 * LUVEX Form-Ready Country Selector & Phone Sync
 *
 * Description: Steuert eine für Formulare optimierte, durchsuchbare Länderauswahl,
 * die mit separaten Telefon-Vorwahl- und Nummernfeldern synchronisiert ist.
 * Version: 4.0 (Robust & Functional)
 */
document.addEventListener('DOMContentLoaded', function() {
    const selectorElement = document.getElementById('luvex-country-selector');
    // Exit if the component is not on the page
    if (!selectorElement) {
        return;
    }

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

    // Exit if any critical element is missing
    if (!countryInput || !dropdown || !searchInput || !optionsList || !nativeSelect || !flagDisplay || !dialCodeInput || !mobileInput) {
        console.error('LUVEX Country Selector: A required element is missing from the DOM.');
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
        if (forceState === 'open' && !isOpen) {
            selectorElement.classList.add('open');
            searchInput.value = '';
            filterOptions('');
            searchInput.focus();
        } else if (forceState === 'close' && isOpen) {
            selectorElement.classList.remove('open');
        } else if (forceState === undefined) {
             isOpen ? toggleDropdown('close') : toggleDropdown('open');
        }
    };

    const filterOptions = (searchTerm) => {
        const term = searchTerm.toLowerCase();
        options.forEach(option => {
            const name = option.querySelector('.name').textContent.toLowerCase();
            const dialCode = option.querySelector('.dial-code').textContent;
            const isVisible = name.includes(term) || dialCode.includes(term);
            option.classList.toggle('hidden', !isVisible);
        });
    };

    const updateUI = (country, source = 'system') => {
        if (!country) {
            countryInput.value = '';
            flagDisplay.textContent = '';
            nativeSelect.value = '';
            // Don't clear dial code if user is typing it
            if (source !== 'dial_code_input') {
                 dialCodeInput.value = '';
            }
            return;
        }

        countryInput.value = country.name;
        flagDisplay.textContent = country.flag;
        if (nativeSelect.value !== country.code) {
            nativeSelect.value = country.code;
            nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
        }

        if (!userModifiedDialCode || source === 'country_selection') {
            dialCodeInput.value = country.dialCode;
            userModifiedDialCode = false;
        }
    };
    
    const findCountryByDialCode = (dialCode) => {
        if (!dialCode || dialCode.length < 2) return null;
        // Prioritize exact matches
        const exactMatch = countryData.find(c => c.dialCode === dialCode);
        if(exactMatch) return exactMatch;
        // Find longest partial match (e.g., +1-268 vs +1)
        let bestMatch = null;
        for (const country of countryData) {
            if (dialCode.startsWith(country.dialCode)) {
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
        userModifiedDialCode = true;
        const country = findCountryByDialCode(dialCodeInput.value);
        updateUI(country, 'dial_code_input');
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

    // --- Initial State ---
    const defaultCountry = countryData.find(c => c.code === 'DE');
    if (defaultCountry) {
        updateUI(defaultCountry);
    }
});

