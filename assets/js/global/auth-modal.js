/**
 * LUVEX THEME - AUTH MODAL LOGIC (v1.4 - Scoped Flag Selector)
 *
 * Steuert das Auth-Modal, die Tabs und initialisiert die Länderauswahl.
 * KORREKTUR: Der Selektor für die Flagge der Telefonvorwahl ist jetzt
 * auf das Registrierungsformular beschränkt, um Konflikte zu vermeiden.
 */
document.addEventListener('DOMContentLoaded', function() {

    const authModal = document.getElementById('authModal');
    const authTrigger = document.getElementById('auth-modal-trigger');

    if (!authModal || !authTrigger) {
        return;
    }

    const modalContent = authModal.querySelector('.modal-content');
    const feedbackContainer = document.getElementById('auth-feedback');
    let countrySelectorInitialized = false;

    /**
     * Öffnet das Modal.
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
        
        // Initialisiere den Country Selector, wenn der Register-Tab aktiv wird
        if (formType === 'register' && !countrySelectorInitialized) {
            initializeCountrySelector();
            countrySelectorInitialized = true;
        }
    };
    
    // Globale Funktion für die Tab-Buttons im Modal-HTML
    window.showAuthForm = showAuthForm;

    /**
     * Initialisiert die komplette Logik für die Länderauswahl.
     */
    const initializeCountrySelector = function() {
        const selectorElement = document.getElementById('luvex-country-selector-modal');
        if (!selectorElement) {
            console.error('LUVEX Country Selector: Container im Modal nicht gefunden.');
            return;
        }

        // --- DOM Element Selection ---
        const registerForm = document.getElementById('register-form-container');
        const countryInput = selectorElement.querySelector('.country-selector-input');
        const dropdown = selectorElement.querySelector('.selector-dropdown');
        const searchInput = selectorElement.querySelector('.country-search');
        const optionsList = selectorElement.querySelector('.country-list-options');
        const options = optionsList.querySelectorAll('li');
        const nativeSelect = selectorElement.querySelector('.native-select');
        const flagDisplay = selectorElement.querySelector('.selected-country-flag');
        
        const dialCodeInput = document.getElementById('phone-input-dial-code-modal');
        const mobileInput = document.getElementById('phone-input-mobile-modal');
        // FIX: Selektor auf das Registrierungsformular beschränkt.
        const dialCodeFlag = registerForm.querySelector('.phone-dial-code-flag');

        if (!countryInput || !dropdown || !searchInput || !optionsList || !nativeSelect || !flagDisplay || !dialCodeInput || !mobileInput || !dialCodeFlag) {
            console.error('LUVEX Country Selector: Ein erforderliches Element fehlt im Modal. Bitte HTML-Struktur prüfen.');
            return;
        }

        let userModifiedDialCode = false;

        const countryData = Array.from(options).map(option => ({
            code: option.dataset.countryCode,
            dialCode: option.dataset.dialCode,
            name: option.querySelector('.name').textContent,
            flag: option.querySelector('.flag').textContent
        }));

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

            countryInput.value = country.name;
            flagDisplay.textContent = country.flag;
            if (nativeSelect.value !== country.code) {
                nativeSelect.value = country.code;
                nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
            }

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
            userModifiedDialCode = true;
            const country = findCountryByDialCode(dialCodeInput.value);
            if (country) {
                dialCodeFlag.textContent = country.flag;
            } else {
                dialCodeFlag.textContent = ' ';
            }
            if (!countryInput.value.trim()) {
                if (country) {
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
        
        mobileInput.addEventListener('blur', () => {
            if (mobileInput.value.trim() !== '') {
                mobileInput.classList.add('completed');
            } else {
                mobileInput.classList.remove('completed');
            }
        });
         mobileInput.addEventListener('focus', () => {
            mobileInput.classList.remove('completed');
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

        const initialCountryCode = nativeSelect.value;
        if(initialCountryCode) {
            const initialCountry = countryData.find(c => c.code === initialCountryCode);
            if (initialCountry) {
                updateUI(initialCountry, 'initial');
            }
        }
    };

    // --- MAIN EVENT LISTENERS for MODAL ---
    authTrigger.addEventListener('click', () => {
        openAuthModal('login');
    });

    authModal.addEventListener('click', (event) => {
        if (event.target === authModal) {
            closeAuthModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && authModal.classList.contains('active')) {
            closeAuthModal();
        }
    });
});

