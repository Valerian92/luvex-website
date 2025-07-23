/**
 * LUVEX UV Simulator - JavaScript Functions
 * Erweiterte Funktionalitäten für die Simulator Page Templates
 * * @version 1.0.1
 */

(function($) {
    'use strict';

    // Global Simulator Object
    window.LuvexSimulator = {
        initialized: false,
        currentUser: null,
        apiBase: '',
        nonce: '',
        
        // Initialize the simulator
        init: function() {
            if (this.initialized) return;
            
            this.apiBase = window.luvexAjax?.resturl || '/wp-json/luvex/v1/';
            this.nonce = window.luvexAjax?.nonce || '';
            this.currentUser = window.luvexAjax?.current_user_id || null;
            
            this.initializeComponents();
            this.initialized = true;
            
            console.log('LUVEX Simulator initialized');
            this.bindEvents(); // An das Ende verschoben für Stabilität
        },
        
        // Initialize page-specific components
        initializeComponents: function() {
            const page = document.body.className;
            
            if (page.includes('page-simulator')) {
                this.initSimulatorPage();
            } else if (page.includes('page-my-simulations')) {
                this.initSimulationsPage();
            } else if (page.includes('page-my-profile')) {
                this.initProfilePage();
            } else if (page.includes('page-simulator-login')) {
                this.initAuthPage();
            }
        },
        
        // ========= SIMULATOR PAGE =========
        
        initSimulatorPage: function() {
            console.log('Initializing Simulator Page');
            this.setupToolPanel();
            this.setupSimulationControls();
            this.setupAutoSave();
            this.loadRecentSimulations();
        },
        
        setupToolPanel: function() {
            $('.tool-btn').on('click', function() {
                $('.tool-btn').removeClass('active');
                $(this).addClass('active');
                const tool = $(this).data('tool');
                LuvexSimulator.switchTool(tool);
            });
        },
        
        switchTool: function(tool) {
            console.log('Switching to tool:', tool);
            $('.tool-panel-content').hide();
            $(`.tool-panel-${tool}`).show();
            this.updateWorkspace(tool);
        },
        
        updateWorkspace: function(tool) {
            const workspace = $('.simulator-viewport');
            workspace.removeClass('tool-layout tool-lamps tool-materials tool-analysis');
            workspace.addClass(`tool-${tool}`);
        },
        
        setupSimulationControls: function() {
            $('#simulation-mode').on('change', function() {
                const mode = $(this).val();
                LuvexSimulator.updateSimulationMode(mode);
            });
            $('#target-pathogen').on('change', function() {
                const pathogen = $(this).val();
                LuvexSimulator.updateTargetPathogen(pathogen);
            });
            $('#start-simulation').on('click', () => this.startSimulation());
        },
        
        updateSimulationMode: function(mode) {
            console.log('Simulation mode changed to:', mode);
            $('.mode-specific').hide();
            $(`.mode-${mode}`).show();
            this.loadModeSettings(mode);
        },
        
        updateTargetPathogen: function(pathogen) {
            console.log('Target pathogen changed to:', pathogen);
            if (pathogen) {
                this.loadPathogenData(pathogen);
            }
        },
        
        startSimulation: function() {
            const mode = $('#simulation-mode').val();
            const pathogen = $('#target-pathogen').val();
            console.log('Starting simulation:', { mode, pathogen });
            this.showProgress('Initializing simulation...', 0);
            this.simulateProgress();
        },
        
        // ========= SIMULATIONS PAGE =========
        
        initSimulationsPage: function() {
            console.log('Initializing Simulations Page');
            this.setupSearchAndFilter();
            this.setupViewToggle();
            this.setupSimulationActions();
            this.loadSimulations();
        },
        
        setupSearchAndFilter: function() {
            $('#simulation-search').on('input', this.debounce(() => {
                LuvexSimulator.filterSimulations();
            }, 300));
            $('#mode-filter, #sort-filter').on('change', () => {
                LuvexSimulator.filterSimulations();
            });
        },
        
        setupViewToggle: function() {
            $('.view-btn').on('click', function() {
                $('.view-btn').removeClass('active');
                $(this).addClass('active');
                const view = $(this).data('view');
                LuvexSimulator.switchView(view);
            });
        },
        
        switchView: function(view) {
            const grid = $('#simulations-grid');
            if (view === 'list') {
                grid.addClass('list-view');
            } else {
                grid.removeClass('list-view');
            }
        },
        
        setupSimulationActions: function() {
            $(document).on('click', '.simulation-action', function(e) {
                e.preventDefault();
                const action = $(this).data('action');
                const simulationId = $(this).closest('.simulation-card').data('simulation-id');
                LuvexSimulator.handleSimulationAction(action, simulationId);
            });
        },
        
        handleSimulationAction: function(action, simulationId) {
            switch (action) {
                case 'open':
                    window.location.href = `/simulator/?load=${simulationId}`;
                    break;
                //... other cases
            }
        },
        
        // ========= PROFILE PAGE =========
        
        initProfilePage: function() {
            console.log('Initializing Profile Page');
            this.setupProfileEditing();
            this.setupPreferences();
            this.updateSystemStatus();
            this.loadDashboardData();
        },
        
        setupProfileEditing: function() {
            $('.btn-edit').on('click', function() {
                const section = $(this).closest('.profile-card');
                LuvexSimulator.enableEditing(section);
            });
        },
        
        enableEditing: function(section) {
            section.find('.info-item span').each(function() {
                const value = $(this).text();
                const field = $(this).parent().find('label').text().toLowerCase().replace(' ', '_');
                $(this).replaceWith(`<input type="text" class="edit-field" data-field="${field}" value="${value}">`);
            });
            section.find('.btn-edit').text('Save').removeClass('btn-edit').addClass('btn-save');
        },
        
        setupPreferences: function() {
            $('.toggle-switch input').on('change', function() {
                const preference = $(this).closest('.preference-item').find('label').text();
                const value = $(this).is(':checked');
                LuvexSimulator.updatePreference(preference, value);
            });
        },
        
        updatePreference: function(preference, value) {
            console.log('Updating preference:', preference, value);
            const item = $(`.preference-item:contains("${preference}")`);
            item.addClass('updating');
            setTimeout(() => {
                item.removeClass('updating').addClass('updated');
                setTimeout(() => item.removeClass('updated'), 1000);
            }, 500);
        },
        
        // ========= AUTH PAGE =========
        
        initAuthPage: function() {
            console.log('Initializing Auth Page');
            this.setupAuthTabs();
            this.setupFormValidation();
            this.setupPasswordStrength();
            this.setupSocialAuth();
        },
        
        setupAuthTabs: function() {
            $('.auth-tab').on('click', function() {
                const tab = $(this).data('tab');
                LuvexSimulator.switchAuthTab(tab);
            });
        },
        
        switchAuthTab: function(tab) {
            $('.auth-tab').removeClass('active');
            $(`.auth-tab[data-tab="${tab}"]`).addClass('active');
            $('.auth-form').removeClass('active');
            $(`#${tab}-form`).addClass('active');
        },
        
        setupFormValidation: function() {
            $('input[type="email"]').on('blur', this.validateEmail);
            $('input[name="username"]').on('blur', this.validateUsername);
            $('input[name="confirm_password"]').on('input', this.validatePasswordMatch);
        },
        
        validateEmail: function() {
            const email = $(this).val();
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            $(this).toggleClass('invalid', !isValid && email.length > 0);
        },
        
        validateUsername: function() {
            const username = $(this).val();
            const isValid = /^[a-zA-Z0-9_]{3,}$/.test(username);
            $(this).toggleClass('invalid', !isValid && username.length > 0);
        },
        
        validatePasswordMatch: function() {
            const password = $('#register-password').val();
            const confirm = $(this).val();
            $(this).toggleClass('invalid', confirm.length > 0 && password !== confirm);
        },
        
        setupPasswordStrength: function() {
            $('#register-password').on('input', function() {
                const password = $(this).val();
                const strength = LuvexSimulator.calculatePasswordStrength(password);
                LuvexSimulator.updatePasswordStrengthUI(strength);
            });
        },
        
        calculatePasswordStrength: function(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            return score;
        },
        
        updatePasswordStrengthUI: function(strength) {
            const fill = $('.strength-fill');
            const text = $('.strength-text');
            fill.removeClass('weak fair good strong');
            if (strength === 0) {
                text.text('Password strength');
                return;
            }
            const levels = ['weak', 'weak', 'fair', 'good', 'strong'];
            const level = levels[strength];
            fill.addClass(level);
            text.text(`${level.charAt(0).toUpperCase() + level.slice(1)} password`);
        },
        
        // ========= UTILITY FUNCTIONS =========
        
        handleFormSubmit: function(e) {
            e.preventDefault();
            const form = $(e.target);
            const action = form.data('action');
            if (!this.validateForm(form)) return false;
            this.submitForm(form, action);
        },
        
        validateForm: function(form) {
            let isValid = true;
            form.find('[required]').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('invalid');
                }
            });
            return isValid;
        },
        
        submitForm: function(form, action) {
            const data = form.serialize();
            this.showLoading(true);
            $.ajax({
                url: this.apiBase + action,
                method: 'POST',
                data: data,
                success: (response) => this.handleFormSuccess(response, form),
                error: (xhr) => this.handleFormError(xhr, form),
                complete: () => this.showLoading(false)
            });
        },
        
        handleFormSuccess: function(response, form) {
            this.showMessage(response.message || 'Success!', 'success');
            if (response.redirect_url) {
                setTimeout(() => window.location.href = response.redirect_url, 1500);
            }
        },
        
        handleFormError: function(xhr, form) {
            const message = xhr.responseJSON?.message || 'An error occurred';
            this.showMessage(message, 'error');
        },
        
        setupAutoSave: function() {
            $('.auto-save-trigger').on('change input', this.debounce(() => {
                LuvexSimulator.performAutoSave();
            }, 2000));
        },
        
        performAutoSave: function() {
            const data = this.collectSimulationData();
            if (Object.keys(data).length === 0) return;
            console.log('Auto-saving simulation data...');
            this.saveSimulationData(data, true);
        },
        
        collectSimulationData: function() {
            return {
                mode: $('#simulation-mode').val(),
                pathogen: $('#target-pathogen').val(),
            };
        },
        
        saveSimulationData: function(data, isAutoSave = false) {
            this.apiCall('save-simulation', 'POST', data)
                .done(function() {
                    if (!isAutoSave) LuvexSimulator.showMessage('Simulation saved!', 'success');
                    else console.log('Auto-save successful');
                })
                .fail(function() {
                    if (!isAutoSave) LuvexSimulator.showMessage('Failed to save simulation', 'error');
                });
        },
        
        setupProgressTracking: function() {
            this.progressSteps = [];
            this.currentStep = 0;
        },
        
        showProgress: function(message, percent) {
            let progressBar = $('.progress-container');
            if (progressBar.length === 0) {
                progressBar = $('<div class="progress-container"><div class="progress-bar"><div class="progress-fill"></div></div><div class="progress-message"></div></div>');
                $('body').append(progressBar);
            }
            progressBar.find('.progress-fill').css('width', percent + '%');
            progressBar.find('.progress-message').text(message);
            progressBar.show();
        },
        
        hideProgress: function() {
            $('.progress-container').hide();
        },
        
        simulateProgress: function() {
            const steps = [
                { message: 'Initializing simulation...', percent: 10 },
                { message: 'Loading lamp configurations...', percent: 25 },
                { message: 'Calculating UV distribution...', percent: 50 },
                { message: 'Processing pathogen data...', percent: 75 },
                { message: 'Generating results...', percent: 90 },
                { message: 'Simulation complete!', percent: 100 }
            ];
            let currentStep = 0;
            const progressInterval = setInterval(() => {
                if (currentStep < steps.length) {
                    this.showProgress(steps[currentStep].message, steps[currentStep].percent);
                    currentStep++;
                } else {
                    clearInterval(progressInterval);
                    setTimeout(() => {
                        this.hideProgress();
                        this.showMessage('Simulation completed successfully!', 'success');
                    }, 1000);
                }
            }, 1000);
        },
        
        openModal: function(e) {
            e.preventDefault();
            const modalId = $(e.currentTarget).data('modal');
            $(`#${modalId}`).fadeIn(300);
            $('body').addClass('modal-open');
        },
        
        closeModal: function(e) {
            if (e.target === e.currentTarget) {
                $(e.target).closest('.modal-overlay').fadeOut(300);
                $('body').removeClass('modal-open');
            }
        },
        
        confirmAction: function(e) {
            const message = $(e.currentTarget).data('confirm');
            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }
        },
        
        showLoading: function(show) {
            let overlay = $('.loading-overlay');
            if (show) {
                if (overlay.length === 0) {
                    overlay = $('<div class="loading-overlay"><div class="loading-spinner"><i class="fas fa-atom fa-spin"></i></div></div>');
                    $('body').append(overlay);
                }
                overlay.fadeIn(200);
            } else {
                overlay.fadeOut(200);
            }
        },
        
        showMessage: function(text, type) {
            const toast = $(`<div class="toast-message toast-${type}"><div class="toast-icon"><i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i></div><div class="toast-text">${text}</div><button class="toast-close"><i class="fas fa-times"></i></button></div>`);
            $('body').append(toast);
            setTimeout(() => toast.fadeOut(300, () => toast.remove()), 5000);
            toast.find('.toast-close').on('click', () => toast.fadeOut(300, () => toast.remove()));
        },
        
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },
        
        apiCall: function(endpoint, method = 'GET', data = null) {
            return $.ajax({
                url: this.apiBase + endpoint,
                method: method,
                data: data ? JSON.stringify(data) : null,
                contentType: data ? 'application/json' : undefined,
                headers: { 'X-WP-Nonce': this.nonce }
            });
        },
        
        loadRecentSimulations: function() {
            this.apiCall('simulator-data')
                .done((response) => {
                    if (response.success && response.data.simulations) {
                        this.displayRecentSimulations(response.data.simulations.slice(0, 5));
                    }
                });
        },
        
        displayRecentSimulations: function(simulations) {
            console.log('Recent simulations:', simulations);
        },
        
        loadModeSettings: function(mode) {
            console.log('Loading settings for mode:', mode);
        },
        
        loadPathogenData: function(pathogen) {
            console.log('Loading pathogen data for:', pathogen);
        },
        
        setupSocialAuth: function() {
            $('.social-auth-btn').on('click', function(e) {
                e.preventDefault();
                const provider = $(this).data('provider');
                console.log('Social auth with:', provider);
            });
        },

        // KORRIGIERTE VERSION: BIND EVENTS MIT ARROW FUNCTIONS
        bindEvents: function() {
            // Global form validation
            $(document).on('submit', '.simulator-form', (e) => this.handleFormSubmit(e));
        
            // Auto-save functionality
            $(document).on('input change', '.auto-save-field', this.debounce( (e) => this.autoSave(e), 2000));
        
            // Modal handling
            $(document).on('click', '[data-modal]', (e) => this.openModal(e));
            $(document).on('click', '.modal-close, .modal-overlay', (e) => this.closeModal(e));
        
            // Confirmation dialogs
            $(document).on('click', '[data-confirm]', (e) => this.confirmAction(e));
        
            // Progress tracking
            this.setupProgressTracking();
        },
    };

    // Initialize when document is ready
    $(document).ready(function() {
        LuvexSimulator.init();
    });

    // Additional CSS for dynamic elements
    const dynamicStyles = `
        <style>
        .progress-container { position: fixed; bottom: 20px; right: 20px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10000; min-width: 300px; display: none; }
        .progress-bar { width: 100%; height: 6px; background: #f1f5f9; border-radius: 3px; overflow: hidden; margin-bottom: 10px; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #007BFF, #6dd5ed); transition: width 0.3s ease; }
        .progress-message { font-size: 14px; color: #374151; font-weight: 500; }
        .toast-message { position: fixed; top: 20px; right: 20px; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 10001; display: flex; align-items: center; gap: 10px; min-width: 300px; border-left: 4px solid; }
        .toast-success { border-left-color: #10b981; }
        .toast-error { border-left-color: #dc2626; }
        .toast-icon { font-size: 18px; }
        .toast-success .toast-icon { color: #10b981; }
        .toast-error .toast-icon { color: #dc2626; }
        .toast-close { background: none; border: none; cursor: pointer; padding: 5px; color: #6b7280; margin-left: auto; }
        .loading-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); display: flex; align-items: center; justify-content: center; z-index: 10002; }
        .loading-spinner { font-size: 3rem; color: #6dd5ed; }
        .modal-open { overflow: hidden; }
        .invalid { border-color: #dc2626 !important; box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important; }
        .updating { opacity: 0.7; pointer-events: none; }
        .updated { border-color: #10b981 !important; transition: border-color 0.3s ease; }
        </style>
    `;
    
    $('head').append(dynamicStyles);

})(jQuery);