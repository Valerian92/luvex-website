<?php
/**
 * Template for User Profile Page
 * Template Name: My Profile
 */

get_header(); ?>

<div class="profile-page-container">
    <?php if (!is_user_logged_in()) : ?>
        <!-- Redirect non-authenticated users -->
        <section class="page-hero-section">
            <div class="hero-content">
                <h1><i class="fas fa-user uv-glow"></i> My Profile</h1>
                <p>Manage your UV simulation account and preferences.</p>
                <?php echo luvex_simulator_access_prompt_html(); ?>
            </div>
        </section>
    <?php else : 
        $current_user = wp_get_current_user(); ?>
        
        <!-- Authenticated User Interface -->
        <section class="profile-interface-section">
            <div class="content-wrapper">
                
                <!-- Profile Header -->
                <div class="profile-header-card">
                    <div class="profile-avatar-section">
                        <div class="avatar-wrapper">
                            <?php echo get_avatar($current_user->ID, 120, '', '', array('class' => 'user-avatar')); ?>
                            <div class="avatar-status">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="user-info">
                            <h1><?php echo esc_html($current_user->display_name); ?></h1>
                            <p class="user-email"><?php echo esc_html($current_user->user_email); ?></p>
                            <p class="user-role">UV Simulation Professional</p>
                            <div class="member-since">
                                <i class="fas fa-calendar-alt"></i>
                                Member since <?php echo date('F Y', strtotime($current_user->user_registered)); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="profile-simulations">-</div>
                                <div class="stat-label">Total Simulations</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="profile-lamps">-</div>
                                <div class="stat-label">Custom Lamps</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="profile-hours">-</div>
                                <div class="stat-label">Hours Simulated</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number" id="profile-achievements">3</div>
                                <div class="stat-label">Achievements</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="profile-content-grid">
                    
                    <!-- Account Information -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-user-circle"></i> Account Information</h3>
                            <button class="btn-edit" onclick="editAccountInfo()">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                        <div class="card-content">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Username</label>
                                    <span><?php echo esc_html($current_user->user_login); ?></span>
                                </div>
                                <div class="info-item">
                                    <label>Email Address</label>
                                    <span><?php echo esc_html($current_user->user_email); ?></span>
                                </div>
                                <div class="info-item">
                                    <label>Display Name</label>
                                    <span><?php echo esc_html($current_user->display_name); ?></span>
                                </div>
                                <div class="info-item">
                                    <label>WordPress ID</label>
                                    <span><?php echo $current_user->ID; ?></span>
                                </div>
                                <div class="info-item">
                                    <label>Account Status</label>
                                    <span class="status-active">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                </div>
                                <div class="info-item">
                                    <label>Subscription</label>
                                    <span class="subscription-free">
                                        <i class="fas fa-user"></i> Free Account
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-history"></i> Recent Activity</h3>
                            <a href="/my-simulations/" class="btn-link">View All</a>
                        </div>
                        <div class="card-content">
                            <div id="recent-activity-list" class="activity-list">
                                <div class="activity-item loading">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <span>Loading recent activity...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-server"></i> System Status</h3>
                            <button class="btn-refresh" onclick="refreshSystemStatus()">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="card-content">
                            <div class="status-grid">
                                <div class="status-item" id="wordpress-status">
                                    <div class="status-indicator">
                                        <i class="fas fa-wordpress"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">WordPress</div>
                                        <div class="status-value">Connected</div>
                                    </div>
                                    <div class="status-badge success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="status-item" id="supabase-status">
                                    <div class="status-indicator">
                                        <i class="fas fa-database"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">Supabase Database</div>
                                        <div class="status-value" id="supabase-status-text">Testing...</div>
                                    </div>
                                    <div class="status-badge" id="supabase-status-badge">
                                        <i class="fas fa-spinner fa-spin"></i>
                                    </div>
                                </div>
                                <div class="status-item" id="simulator-status">
                                    <div class="status-indicator">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">Simulator Server</div>
                                        <div class="status-value">In Development</div>
                                    </div>
                                    <div class="status-badge warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <div class="status-item" id="auth-status">
                                    <div class="status-indicator">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">Authentication</div>
                                        <div class="status-value">Active Session</div>
                                    </div>
                                    <div class="status-badge success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                        </div>
                        <div class="card-content">
                            <div class="action-grid">
                                <a href="/simulator/" class="action-item primary">
                                    <div class="action-icon">
                                        <i class="fas fa-flask"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Start Simulation</div>
                                        <div class="action-description">Create new UV simulation</div>
                                    </div>
                                </a>
                                <a href="/my-simulations/" class="action-item">
                                    <div class="action-icon">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">My Simulations</div>
                                        <div class="action-description">View saved projects</div>
                                    </div>
                                </a>
                                <button class="action-item" onclick="exportUserData()">
                                    <div class="action-icon">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Export Data</div>
                                        <div class="action-description">Download your data</div>
                                    </div>
                                </button>
                                <button class="action-item" onclick="contactSupport()">
                                    <div class="action-icon">
                                        <i class="fas fa-life-ring"></i>
                                    </div>
                                    <div class="action-content">
                                        <div class="action-title">Support</div>
                                        <div class="action-description">Get help</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3><i class="fas fa-cog"></i> Preferences</h3>
                        </div>
                        <div class="card-content">
                            <div class="preferences-grid">
                                <div class="preference-item">
                                    <div class="preference-info">
                                        <label>Email Notifications</label>
                                        <span>Receive updates about your simulations</span>
                                    </div>
                                    <div class="preference-control">
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="preference-item">
                                    <div class="preference-info">
                                        <label>Auto-save Simulations</label>
                                        <span>Automatically save simulation progress</span>
                                    </div>
                                    <div class="preference-control">
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="preference-item">
                                    <div class="preference-info">
                                        <label>Advanced Mode</label>
                                        <span>Show advanced simulation options</span>
                                    </div>
                                    <div class="preference-control">
                                        <label class="toggle-switch">
                                            <input type="checkbox">
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Actions -->
                    <div class="profile-card danger-zone">
                        <div class="card-header">
                            <h3><i class="fas fa-exclamation-triangle"></i> Account Actions</h3>
                        </div>
                        <div class="card-content">
                            <div class="danger-actions">
                                <button class="danger-btn" onclick="changePassword()">
                                    <i class="fas fa-key"></i>
                                    Change Password
                                </button>
                                <button class="danger-btn" onclick="clearSimulationData()">
                                    <i class="fas fa-trash-alt"></i>
                                    Clear All Simulation Data
                                </button>
                                <a href="<?php echo wp_logout_url('/'); ?>" class="danger-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<style>
/* Profile Page Styles */
.profile-page-container {
    min-height: 100vh;
    background: var(--luvex-bg-section-light);
}

.profile-interface-section {
    padding: calc(6rem + 80px) 2rem 4rem;
}

/* Profile Header */
.profile-header-card {
    background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue));
    color: var(--luvex-text-on-dark);
    padding: 2.5rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.profile-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 400px;
    height: 100%;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.2) 0%, transparent 70%);
    pointer-events: none;
}

.profile-avatar-section {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.avatar-wrapper {
    position: relative;
}

.user-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.avatar-status {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 30px;
    height: 30px;
    background: var(--luvex-bright-cyan);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid var(--luvex-dark-blue);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.avatar-status i {
    color: var(--luvex-dark-blue);
    font-size: 0.9rem;
}

.user-info h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.user-email {
    margin: 0 0 0.25rem 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.user-role {
    margin: 0 0 1rem 0;
    color: var(--luvex-bright-cyan);
    font-weight: 600;
    font-size: 1rem;
}

.member-since {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    opacity: 0.8;
}

.profile-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    position: relative;
    z-index: 2;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: var(--luvex-bright-cyan);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--luvex-dark-blue);
    flex-shrink: 0;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--luvex-bright-cyan);
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.25rem;
}

/* Content Grid */
.profile-content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.profile-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--luvex-border-color);
    overflow: hidden;
    height: fit-content;
}

.profile-card.danger-zone {
    border-color: #fecaca;
    background: #fef2f2;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--luvex-border-color);
    background: var(--luvex-bg-section-alt);
}

.danger-zone .card-header {
    background: #fee2e2;
    border-bottom-color: #fecaca;
}

.card-header h3 {
    margin: 0;
    color: var(--luvex-text-on-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
}

.danger-zone .card-header h3 {
    color: #dc2626;
}

.btn-edit, .btn-refresh, .btn-link {
    padding: 0.5rem 1rem;
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border: none;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-link {
    background: transparent;
    color: var(--luvex-accent-blue);
    border: 1px solid var(--luvex-accent-blue);
}

.btn-edit:hover, .btn-refresh:hover, .btn-link:hover {
    background: var(--luvex-bright-cyan);
    transform: translateY(-1px);
}

.card-content {
    padding: 1.5rem;
}

/* Account Information */
.info-grid {
    display: grid;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--luvex-border-color);
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    font-weight: 600;
    color: var(--luvex-text-muted-light);
    font-size: 0.9rem;
}

.info-item span {
    color: var(--luvex-text-on-light);
    font-weight: 500;
}

.status-active {
    color: #10b981 !important;
}

.subscription-free {
    color: var(--luvex-accent-blue) !important;
}

/* Activity List */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--luvex-bg-section-alt);
    border-radius: 8px;
    border: 1px solid var(--luvex-border-color);
}

.activity-item.loading {
    color: var(--luvex-text-muted-light);
}

.activity-item i {
    color: var(--luvex-accent-blue);
    font-size: 1rem;
    width: 16px;
    text-align: center;
}

/* System Status */
.status-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--luvex-bg-section-alt);
    border-radius: 8px;
    border: 1px solid var(--luvex-border-color);
}

.status-indicator {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: var(--luvex-accent-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.status-content {
    flex: 1;
}

.status-label {
    font-weight: 600;
    color: var(--luvex-text-on-light);
    font-size: 0.95rem;
}

.status-value {
    color: var(--luvex-text-muted-light);
    font-size: 0.9rem;
    margin-top: 0.25rem;
}

.status-badge {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    flex-shrink: 0;
}

.status-badge.success {
    background: #10b981;
    color: white;
}

.status-badge.warning {
    background: #f59e0b;
    color: white;
}

.status-badge.error {
    background: #dc2626;
    color: white;
}

/* Quick Actions */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.action-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--luvex-bg-section-alt);
    border: 1px solid var(--luvex-border-color);
    border-radius: 8px;
    color: var(--luvex-text-on-light);
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.action-item.primary {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

.action-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: var(--luvex-accent-blue);
}

.action-item.primary:hover {
    background: var(--luvex-bright-cyan);
    border-color: var(--luvex-bright-cyan);
}

.action-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(0, 123, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--luvex-accent-blue);
    flex-shrink: 0;
}

.action-item.primary .action-icon {
    background: rgba(255, 255, 255, 0.2);
    color: var(--luvex-text-on-dark);
}

.action-title {
    font-weight: 600;
    font-size: 0.95rem;
}

.action-description {
    font-size: 0.85rem;
    opacity: 0.8;
    margin-top: 0.25rem;
}

/* Preferences */
.preferences-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.preference-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--luvex-bg-section-alt);
    border-radius: 8px;
    border: 1px solid var(--luvex-border-color);
}

.preference-info label {
    font-weight: 600;
    color: var(--luvex-text-on-light);
    display: block;
    margin-bottom: 0.25rem;
}

.preference-info span {
    font-size: 0.9rem;
    color: var(--luvex-text-muted-light);
}

/* Toggle Switch */
.toggle-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 26px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: var(--luvex-accent-blue);
}

input:checked + .toggle-slider:before {
    transform: translateX(24px);
}

/* Danger Zone */
.danger-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.danger-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: transparent;
    border: 1px solid #dc2626;
    color: #dc2626;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    justify-content: flex-start;
}

.danger-btn:hover {
    background: #dc2626;
    color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-content-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .profile-avatar-section {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .profile-stats-grid {
        grid-template-columns: 1fr;
    }
    
    .action-grid {
        grid-template-columns: 1fr;
    }
    
    .status-item {
        flex-wrap: wrap;
        gap: 0.75rem;
    }
}

@media (max-width: 480px) {
    .profile-content-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .preference-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}
</style>

<script>
// Profile Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeProfilePage();
    loadProfileData();
    testSystemConnections();
});

function initializeProfilePage() {
    // Initialize any interactive elements
    console.log('Profile page initialized');
}

async function loadProfileData() {
    try {
        const response = await fetch('/wp-json/luvex/v1/simulator-data');
        const data = await response.json();
        
        if (data.success) {
            // Update statistics
            document.getElementById('profile-simulations').textContent = 
                data.data.simulations ? data.data.simulations.length : 0;
            document.getElementById('profile-lamps').textContent = 
                data.data.lamps ? data.data.lamps.length : 0;
            document.getElementById('profile-hours').textContent = 
                calculateSimulationHours(data.data.simulations);
            
            // Load recent activity
            loadRecentActivity(data.data.simulations);
        }
    } catch (error) {
        console.error('Error loading profile data:', error);
        showDataLoadError();
    }
}

function calculateSimulationHours(simulations) {
    // Placeholder calculation - would be based on actual simulation data
    if (!simulations) return '0';
    return (simulations.length * 2.5).toFixed(1); // Estimate 2.5 hours per simulation
}

function loadRecentActivity(simulations) {
    const activityList = document.getElementById('recent-activity-list');
    
    if (!simulations || simulations.length === 0) {
        activityList.innerHTML = `
            <div class="activity-item">
                <i class="fas fa-info-circle"></i>
                <span>No recent activity yet. Start your first simulation!</span>
            </div>
        `;
        return;
    }
    
    // Get last 5 simulations and create activity items
    const recentSimulations = simulations
        .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
        .slice(0, 5);
    
    activityList.innerHTML = recentSimulations.map(sim => `
        <div class="activity-item">
            <i class="fas fa-flask"></i>
            <span>Created simulation "${sim.simulation_name || 'Unnamed'}" - ${formatRelativeTime(sim.created_at)}</span>
        </div>
    `).join('');
}

async function testSystemConnections() {
    // Test Supabase connection
    try {
        const response = await fetch('/wp-json/luvex/v1/test-connection');
        const data = await response.json();
        
        const statusText = document.getElementById('supabase-status-text');
        const statusBadge = document.getElementById('supabase-status-badge');
        
        if (data.success) {
            statusText.textContent = 'Connected';
            statusBadge.className = 'status-badge success';
            statusBadge.innerHTML = '<i class="fas fa-check"></i>';
        } else {
            statusText.textContent = 'Connection Failed';
            statusBadge.className = 'status-badge error';
            statusBadge.innerHTML = '<i class="fas fa-times"></i>';
        }
    } catch (error) {
        const statusText = document.getElementById('supabase-status-text');
        const statusBadge = document.getElementById('supabase-status-badge');
        
        statusText.textContent = 'Error';
        statusBadge.className = 'status-badge error';
        statusBadge.innerHTML = '<i class="fas fa-exclamation"></i>';
    }
}

function refreshSystemStatus() {
    // Reset status indicators
    const statusText = document.getElementById('supabase-status-text');
    const statusBadge = document.getElementById('supabase-status-badge');
    
    statusText.textContent = 'Testing...';
    statusBadge.className = 'status-badge';
    statusBadge.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // Re-test connections
    testSystemConnections();
}

function editAccountInfo() {
    alert('Account editing functionality will be implemented in a future update.');
}

function exportUserData() {
    alert('Data export functionality will be implemented with the Windows server integration.');
}

function contactSupport() {
    window.location.href = '/contact/';
}

function changePassword() {
    if (confirm('You will be redirected to WordPress to change your password. Continue?')) {
        window.location.href = '/wp-admin/profile.php';
    }
}

function clearSimulationData() {
    if (confirm('Are you sure you want to clear ALL simulation data? This action cannot be undone.')) {
        if (confirm('This will permanently delete all your simulations, lamps, and preferences. Are you absolutely sure?')) {
            alert('Data clearing functionality will be implemented with the Windows server integration.');
        }
    }
}

function showDataLoadError() {
    const stats = ['profile-simulations', 'profile-lamps', 'profile-hours'];
    stats.forEach(id => {
        const element = document.getElementById(id);
        if (element) element.textContent = '!';
    });
    
    const activityList = document.getElementById('recent-activity-list');
    activityList.innerHTML = `
        <div class="activity-item">
            <i class="fas fa-exclamation-triangle" style="color: #dc2626;"></i>
            <span>Unable to load activity data</span>
        </div>
    `;
}

function formatRelativeTime(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) return 'just now';
    if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)} minutes ago`;
    if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)} hours ago`;
    if (diffInSeconds < 604800) return `${Math.floor(diffInSeconds / 86400)} days ago`;
    
    return date.toLocaleDateString();
}

// Save preferences when toggles change
document.addEventListener('change', function(event) {
    if (event.target.type === 'checkbox' && event.target.closest('.toggle-switch')) {
        const preference = event.target.closest('.preference-item');
        const label = preference.querySelector('label').textContent;
        console.log(`Preference "${label}" changed to:`, event.target.checked);
        
        // Here you would save the preference to the database
        // For now, just show a temporary indication
        const originalBorder = preference.style.border;
        preference.style.border = '2px solid var(--luvex-bright-cyan)';
        setTimeout(() => {
            preference.style.border = originalBorder;
        }, 1000);
    }
});
</script>

<?php get_footer(); ?>