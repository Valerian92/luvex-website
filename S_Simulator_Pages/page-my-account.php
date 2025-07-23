<?php
/**
 * Template Name: My Account & Configurations
 *
 * A reduced and functional page that combines the user profile
 * and the management of user-specific configurations (lamps, substrates, etc.).
 */

get_header(); 

// Ensure that only logged-in users can see this page.
if (!is_user_logged_in()) {
    // If not logged in, redirect to the login page.
    wp_redirect(home_url('/simulator-login/?redirect_to=' . home_url('/my-account/')));
    exit;
}

// Get current user data.
$current_user = wp_get_current_user();
?>

<div class="account-page-container">
    <div class="content-wrapper">

        <!-- 1. Header section with user info -->
        <div class="account-header">
            <div class="avatar-container">
                <?php echo get_avatar($current_user->ID, 96); ?>
            </div>
            <div class="user-details">
                <h1>My Account</h1>
                <p>Hello, <?php echo esc_html($current_user->display_name); ?>! Manage your profile and configurations here.</p>
            </div>
        </div>

        <!-- 2. Tab Navigation -->
        <div class="account-tabs">
            <button class="tab-link active" data-tab="profile">
                <i class="fas fa-user-circle"></i> Profile
            </button>
            <button class="tab-link" data-tab="lamps">
                <i class="fas fa-lightbulb"></i> My Lamps
            </button>
            <button class="tab-link" data-tab="substrates">
                <i class="fas fa-layer-group"></i> My Substrates
            </button>
            <button class="tab-link" data-tab="pathogens">
                <i class="fas fa-bacterium"></i> My Pathogens
            </button>
        </div>

        <!-- 3. Tab Content -->
        <div class="account-content">

            <!-- Profile Tab -->
            <div id="profile" class="tab-pane active">
                <h3>Profile Information</h3>
                <div class="info-card">
                    <div class="info-item">
                        <label>Display Name:</label>
                        <span><?php echo esc_html($current_user->display_name); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Email Address:</label>
                        <span><?php echo esc_html($current_user->user_email); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Username:</label>
                        <span><?php echo esc_html($current_user->user_login); ?></span>
                    </div>
                    <div class="info-item">
                        <label>Registered since:</label>
                        <span><?php echo date('F j, Y', strtotime($current_user->user_registered)); ?></span>
                    </div>
                </div>
                <h3>Account Actions</h3>
                <div class="info-card">
                     <a href="<?php echo wp_logout_url(home_url()); ?>" class="action-button logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Lamps Tab -->
            <div id="lamps" class="tab-pane">
                <div class="config-header">
                    <h3>My Lamp Library</h3>
                    <button id="add-lamp-btn" class="action-button">
                        <i class="fas fa-plus"></i> Add New Lamp
                    </button>
                </div>

                <!-- Add form (hidden by default) -->
                <div id="add-lamp-form-container" class="form-container" style="display: none;">
                    <h4>Create New Lamp</h4>
                    <form id="add-lamp-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="lamp-name">Lamp Name</label>
                                <input type="text" id="lamp-name" name="lamp_name" placeholder="e.g., My Lab Lamp" required>
                            </div>
                            <div class="form-group">
                                <label for="lamp-type">Lamp Type</label>
                                <select id="lamp-type" name="lamp_type">
                                    <option value="led">LED</option>
                                    <option value="mercury_lp">Low-Pressure Mercury</option>
                                    <option value="mercury_mp">Medium-Pressure Mercury</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group">
                                <label for="lamp-power">Power (W)</label>
                                <input type="number" id="lamp-power" name="lamp_power" placeholder="e.g., 50" required>
                            </div>
                            <div class="form-group">
                                <label for="lamp-wavelength">Wavelength (nm)</label>
                                <input type="number" id="lamp-wavelength" name="lamp_wavelength" placeholder="e.g., 275" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="action-button">Save</button>
                            <button type="button" id="cancel-add-lamp" class="action-button secondary">Cancel</button>
                        </div>
                    </form>
                    <div id="form-message" class="form-message"></div>
                </div>

                <!-- List of Lamps -->
                <div class="config-list-container">
                    <h4>Saved Lamps</h4>
                    <div id="lamp-list" class="config-list">
                        <!-- Lamps will be inserted here via JavaScript -->
                        <p>Loading lamps...</p>
                    </div>
                </div>
            </div>

            <!-- Substrates Tab (Placeholder) -->
            <div id="substrates" class="tab-pane">
                 <h3>My Substrate Library</h3>
                 <p>You will soon be able to manage your own substrates here.</p>
            </div>

            <!-- Pathogens Tab (Placeholder) -->
            <div id="pathogens" class="tab-pane">
                 <h3>My Pathogen Library</h3>
                 <p>You will soon be able to manage your own pathogens here.</p>
            </div>

        </div>
    </div>
</div>

<style>
/* Styles for the "My Account" page */
.account-page-container {
    padding: calc(4rem + 80px) 2rem 4rem;
    background-color: var(--luvex-bg-light, #f8f9fa);
    min-height: 100vh;
}

.account-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.avatar-container img {
    border-radius: 50%;
    border: 4px solid var(--luvex-accent-blue, #007bff);
}

.user-details h1 {
    margin: 0 0 0.25rem 0;
    font-size: 2rem;
    color: var(--luvex-text-dark, #212529);
}

.user-details p {
    margin: 0;
    font-size: 1.1rem;
    color: var(--luvex-text-light, #495057);
}

.account-tabs {
    display: flex;
    gap: 0.5rem;
    border-bottom: 2px solid var(--luvex-border-color, #dee2e6);
    margin-bottom: 2rem;
}

.tab-link {
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    color: var(--luvex-text-light, #495057);
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tab-link:hover {
    color: var(--luvex-text-dark, #212529);
}

.tab-link.active {
    color: var(--luvex-accent-blue, #007bff);
    border-bottom-color: var(--luvex-accent-blue, #007bff);
}

.tab-pane {
    display: none;
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.tab-pane.active {
    display: block;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-pane h3 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    color: var(--luvex-text-dark, #212529);
}

.info-card {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background: var(--luvex-bg-light, #f8f9fa);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--luvex-border-color, #dee2e6);
}

.info-item {
    display: flex;
    justify-content: space-between;
}
.info-item label {
    font-weight: 600;
    color: var(--luvex-text-light, #495057);
}
.info-item span {
    font-weight: 500;
}

.action-button {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: none;
    background-color: var(--luvex-accent-blue, #007bff);
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.action-button:hover {
    background-color: var(--luvex-bright-cyan, #6dd5ed);
}
.action-button.secondary {
    background-color: var(--luvex-text-light, #495057);
}
.action-button.logout {
    background-color: #dc3545;
}

.config-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.form-container {
    background: var(--luvex-bg-light, #f8f9fa);
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    border: 1px solid var(--luvex-border-color, #dee2e6);
}

.form-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}
.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.form-group label {
    margin-bottom: 0.5rem;
    font-weight: 600;
}
.form-group input, .form-group select {
    padding: 0.75rem;
    border: 1px solid var(--luvex-border-color, #dee2e6);
    border-radius: 8px;
    font-size: 1rem;
}
.form-actions {
    margin-top: 1.5rem;
    display: flex;
    gap: 1rem;
}

.form-message {
    margin-top: 1rem;
    padding: 1rem;
    border-radius: 8px;
    display: none;
}
.form-message.success {
    background-color: #d1e7dd;
    color: #0f5132;
}
.form-message.error {
    background-color: #f8d7da;
    color: #842029;
}

.config-list .config-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid var(--luvex-border-color, #dee2e6);
    border-radius: 8px;
    margin-bottom: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Tab logic ----
    const tabs = document.querySelectorAll('.tab-link');
    const panes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Deactivate all
            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));

            // Activate the clicked tab
            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    // ---- Lamp Management ----
    const addLampBtn = document.getElementById('add-lamp-btn');
    const lampFormContainer = document.getElementById('add-lamp-form-container');
    const cancelAddLampBtn = document.getElementById('cancel-add-lamp');
    const addLampForm = document.getElementById('add-lamp-form');
    const lampList = document.getElementById('lamp-list');
    const formMessage = document.getElementById('form-message');

    // Show/hide form
    addLampBtn.addEventListener('click', () => {
        lampFormContainer.style.display = 'block';
        addLampBtn.style.display = 'none';
    });

    cancelAddLampBtn.addEventListener('click', () => {
        lampFormContainer.style.display = 'none';
        addLampBtn.style.display = 'block';
        addLampForm.reset();
        hideMessage();
    });

    // Submit form
    addLampForm.addEventListener('submit', function(event) {
        event.preventDefault();
        showMessage('Saving lamp...', 'info');

        // The AJAX request to WordPress to save the data in Supabase goes here.
        // For this demo, we simulate a success after 1 second.
        
        const lampData = {
            name: this.elements['lamp_name'].value,
            type: this.elements['lamp_type'].value,
            power: this.elements['lamp_power'].value,
            wavelength: this.elements['lamp_wavelength'].value,
        };
        
        console.log('Sending lamp data:', lampData);
        
        // Assumption: AJAX call to a new REST endpoint `/luvex/v1/save-lamp`
        // fetch('/wp-json/luvex/v1/save-lamp', { ... })
        
        setTimeout(() => {
            showMessage('Lamp saved successfully!', 'success');
            addLampToList(lampData); // Add the lamp to the list
            this.reset();
            lampFormContainer.style.display = 'none';
            addLampBtn.style.display = 'block';
        }, 1000);
    });
    
    // Helper function to display messages
    function showMessage(text, type) {
        formMessage.textContent = text;
        formMessage.className = 'form-message ' + type;
        formMessage.style.display = 'block';
    }
    
    function hideMessage() {
        formMessage.style.display = 'none';
    }

    // Function to load lamps (simulated)
    function loadLamps() {
        lampList.innerHTML = '<p>Loading lamps...</p>';
        // The AJAX call to load the lamps from Supabase would go here.
        setTimeout(() => {
            // Example data
            const savedLamps = [
                { id: 1, name: 'Standard LED 275nm', type: 'led', power: 50, wavelength: 275 },
                { id: 2, name: 'Large Mercury Lamp', type: 'mercury_lp', power: 200, wavelength: 254 },
            ];
            
            lampList.innerHTML = ''; // Clear the loading message
            if (savedLamps.length === 0) {
                lampList.innerHTML = '<p>No lamps saved yet.</p>';
            } else {
                savedLamps.forEach(addLampToList);
            }
        }, 1500);
    }
    
    // Function to add a lamp to the UI list
    function addLampToList(lamp) {
        const lampItem = document.createElement('div');
        lampItem.className = 'config-item';
        lampItem.innerHTML = `
            <div>
                <strong>${lamp.name}</strong>
                <small>(${lamp.type}, ${lamp.power}W, ${lamp.wavelength}nm)</small>
            </div>
            <button class="action-button secondary">Delete</button>
        `;
        lampList.appendChild(lampItem);
    }

    // Load the lamps when the tab becomes active
    document.querySelector('[data-tab="lamps"]').addEventListener('click', loadLamps, { once: true });
});
</script>

<?php get_footer(); ?>
