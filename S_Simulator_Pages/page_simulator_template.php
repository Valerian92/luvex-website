<?php
/**
 * Template for UV Simulator Interface
 * Template Name: UV Simulator
 */

get_header(); ?>

<div class="simulator-page-container">
    <?php if (!is_user_logged_in()) : ?>
        <!-- Public Access Prompt -->
        <section class="page-hero-section">
            <div class="hero-content">
                <h1><i class="fas fa-atom uv-glow"></i> UV Simulator</h1>
                <p>Advanced UV disinfection simulation tool for professionals. Create precise UV layouts, calculate dosage distributions, and optimize your UV systems.</p>
                
                <div class="simulator-access-prompt">
                    <div class="access-card">
                        <div class="access-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3>Professional Access Required</h3>
                        <p>Free registration required to access the UV simulator and save your configurations.</p>
                        <div class="access-actions">
                            <a href="/simulator-login/" class="cta-button">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <a href="/simulator-login/?tab=register" class="cta-button">
                                <i class="fas fa-user-plus"></i> Register Free
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- LED Chips Animation -->
            <div class="led-chips">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </section>

        <!-- Feature Preview Section -->
        <section class="section-container">
            <div class="content-wrapper">
                <h2 class="section-title">Simulator Features</h2>
                <div class="info-card-grid">
                    <div class="info-card light">
                        <div class="info-card-icon-wrapper">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h3>3D UV Simulation</h3>
                        <p>Create realistic 3D UV chamber layouts with precise lamp positioning and calculate accurate dosage distributions.</p>
                    </div>
                    <div class="info-card light">
                        <div class="info-card-icon-wrapper">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        <h3>Real-time Analysis</h3>
                        <p>Monitor UV intensity maps, identify hot spots and shadows, and optimize your system performance instantly.</p>
                    </div>
                    <div class="info-card light">
                        <div class="info-card-icon-wrapper">
                            <i class="fas fa-save"></i>
                        </div>
                        <h3>Save & Share</h3>
                        <p>Save your simulation configurations, export detailed reports, and collaborate with your team.</p>
                    </div>
                </div>
            </div>
        </section>

    <?php else : 
        $current_user = wp_get_current_user(); ?>
        
        <!-- Authenticated User Interface -->
        <section class="simulator-interface-section">
            <div class="content-wrapper">
                
                <!-- Header -->
                <div class="simulator-header">
                    <div class="welcome-section">
                        <h1><i class="fas fa-atom uv-glow"></i> UV Simulator</h1>
                        <p class="welcome-text">Welcome back, <?php echo esc_html($current_user->display_name); ?>!</p>
                    </div>
                    <div class="user-actions">
                        <a href="/my-simulations/" class="header-action-btn">
                            <i class="fas fa-history"></i>
                            <span>My Simulations</span>
                        </a>
                        <a href="/my-profile/" class="header-action-btn secondary">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                </div>

                <!-- Simulator Workspace -->
                <div class="simulator-workspace">
                    <div class="workspace-sidebar">
                        <div class="tool-panel">
                            <h3><i class="fas fa-toolbox"></i> Tools</h3>
                            <div class="tool-buttons">
                                <button class="tool-btn active" data-tool="layout">
                                    <i class="fas fa-th-large"></i>
                                    <span>Layout</span>
                                </button>
                                <button class="tool-btn" data-tool="lamps">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Lamps</span>
                                </button>
                                <button class="tool-btn" data-tool="materials">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Materials</span>
                                </button>
                                <button class="tool-btn" data-tool="analysis">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Analysis</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="simulation-controls">
                            <h3><i class="fas fa-sliders-h"></i> Controls</h3>
                            <div class="control-group">
                                <label>Simulation Mode:</label>
                                <select class="form-control" id="simulation-mode">
                                    <option value="surface">Surface Disinfection</option>
                                    <option value="water">Water Treatment</option>
                                    <option value="air">Air Purification</option>
                                </select>
                            </div>
                            <div class="control-group">
                                <label>Target Pathogen:</label>
                                <select class="form-control" id="target-pathogen">
                                    <option value="">Select pathogen...</option>
                                    <option value="covid19">SARS-CoV-2</option>
                                    <option value="ecoli">E. coli</option>
                                    <option value="staph">S. aureus</option>
                                </select>
                            </div>
                            <button class="cta-button" id="start-simulation">
                                <i class="fas fa-play"></i> Start Simulation
                            </button>
                        </div>
                    </div>

                    <div class="workspace-main">
                        <div class="simulator-viewport">
                            <!-- Placeholder for Windows Server Integration -->
                            <div class="simulator-placeholder">
                                <div class="placeholder-content">
                                    <i class="fas fa-flask fa-4x"></i>
                                    <h3>Simulator Initializing...</h3>
                                    <p>The 3D simulator from the Windows server will be embedded here.</p>
                                    
                                    <div class="connection-status">
                                        <div class="status-indicator">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <span>WordPress: Connected</span>
                                        </div>
                                        <div class="status-indicator">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <span>Supabase: Connected</span>
                                        </div>
                                        <div class="status-indicator">
                                            <i class="fas fa-clock text-warning"></i>
                                            <span>Simulator: In Development</span>
                                        </div>
                                    </div>

                                    <div class="dev-controls">
                                        <h4>Development Controls:</h4>
                                        <button class="btn-outline" onclick="loadTestData()">
                                            <i class="fas fa-database"></i> Load Test Data
                                        </button>
                                        <button class="btn-outline" onclick="saveSimulation()">
                                            <i class="fas fa-save"></i> Test Save
                                        </button>
                                        <div id="dev-output"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>

<style>
/* Simulator Page Specific Styles */
.simulator-page-container {
    min-height: 100vh;
    background: var(--luvex-bg-section-light);
}

/* Public Access Styles */
.simulator-access-prompt {
    margin-top: 3rem;
    display: flex;
    justify-content: center;
}

.access-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 3rem;
    border-radius: 20px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 500px;
}

.access-icon {
    font-size: 4rem;
    color: var(--luvex-bright-cyan);
    margin-bottom: 1.5rem;
}

.access-card h3 {
    color: var(--luvex-text-on-dark);
    margin-bottom: 1rem;
    font-size: 1.8rem;
}

.access-card p {
    color: var(--luvex-text-muted-dark);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.access-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Authenticated Interface Styles */
.simulator-interface-section {
    padding: calc(6rem + 80px) 2rem 4rem;
}

.simulator-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue));
    color: var(--luvex-text-on-dark);
    padding: 2.5rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.simulator-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 100%;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.2) 0%, transparent 70%);
    pointer-events: none;
}

.welcome-section h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2.5rem;
    position: relative;
    z-index: 2;
}

.welcome-text {
    margin: 0;
    opacity: 0.9;
    position: relative;
    z-index: 2;
}

.user-actions {
    display: flex;
    gap: 1rem;
    position: relative;
    z-index: 2;
}

.header-action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    color: var(--luvex-text-on-dark);
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.header-action-btn.secondary {
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.header-action-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    color: var(--luvex-text-on-dark);
}

/* Workspace Layout */
.simulator-workspace {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;
    min-height: 600px;
}

.workspace-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.tool-panel, .simulation-controls {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--luvex-border-color);
}

.tool-panel h3, .simulation-controls h3 {
    margin: 0 0 1rem 0;
    color: var(--luvex-text-on-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
}

.tool-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.tool-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: var(--luvex-bg-section-alt);
    border: 1px solid var(--luvex-border-color);
    border-radius: 8px;
    color: var(--luvex-text-on-light);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tool-btn:hover, .tool-btn.active {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

.control-group {
    margin-bottom: 1rem;
}

.control-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--luvex-text-on-light);
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--luvex-border-color);
    border-radius: 8px;
    background: #ffffff;
    color: var(--luvex-text-on-light);
    font-size: 0.95rem;
}

.form-control:focus {
    outline: none;
    border-color: var(--luvex-accent-blue);
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

/* Main Workspace */
.workspace-main {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--luvex-border-color);
}

.simulator-viewport {
    height: 100%;
    min-height: 600px;
    position: relative;
    background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
}

.simulator-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 2rem;
}

.placeholder-content {
    text-align: center;
    max-width: 500px;
}

.placeholder-content i {
    color: var(--luvex-accent-blue);
    margin-bottom: 1.5rem;
    opacity: 0.7;
}

.placeholder-content h3 {
    color: var(--luvex-text-on-light);
    margin-bottom: 1rem;
    font-size: 1.8rem;
}

.placeholder-content p {
    color: var(--luvex-text-muted-light);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.connection-status {
    background: rgba(255, 255, 255, 0.8);
    padding: 1.5rem;
    border-radius: 12px;
    margin: 2rem 0;
    border: 1px solid var(--luvex-border-color);
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0.5rem 0;
    font-size: 0.95rem;
}

.text-success { color: #10b981; }
.text-warning { color: #f59e0b; }

.dev-controls {
    background: rgba(0, 123, 255, 0.05);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid rgba(0, 123, 255, 0.1);
}

.dev-controls h4 {
    color: var(--luvex-text-on-light);
    margin-bottom: 1rem;
}

.btn-outline {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: 2px solid var(--luvex-accent-blue);
    color: var(--luvex-accent-blue);
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0 0.5rem 0.5rem 0;
}

.btn-outline:hover {
    background: var(--luvex-accent-blue);
    color: white;
}

#dev-output {
    margin-top: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    font-family: monospace;
    font-size: 0.9rem;
    min-height: 2rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .simulator-workspace {
        grid-template-columns: 1fr;
    }
    
    .workspace-sidebar {
        order: 2;
    }
    
    .workspace-main {
        order: 1;
    }
}

@media (max-width: 768px) {
    .simulator-header {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
    }
    
    .user-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .header-action-btn {
        justify-content: center;
    }
    
    .access-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .access-card {
        padding: 2rem;
    }
}
</style>

<script>
// Simulator Interface JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeSimulator();
});

function initializeSimulator() {
    // Tool panel interactions
    const toolButtons = document.querySelectorAll('.tool-btn');
    toolButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            toolButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Start simulation button
    const startBtn = document.getElementById('start-simulation');
    if (startBtn) {
        startBtn.addEventListener('click', startSimulation);
    }
}

async function loadTestData() {
    const output = document.getElementById('dev-output');
    output.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading test data...';
    
    try {
        const response = await fetch('/wp-json/luvex/v1/simulator-data', {
            headers: {
                'Authorization': 'Bearer ' + (localStorage.getItem('luvex_jwt_token') || '')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            output.innerHTML = `
                <div style="color: #10b981;">✅ Test data loaded successfully</div>
                <div>Lamps: ${data.data.lamps ? data.data.lamps.length : 0}</div>
                <div>Simulations: ${data.data.simulations ? data.data.simulations.length : 0}</div>
                <div>User ID: <?php echo get_current_user_id(); ?></div>
            `;
        } else {
            output.innerHTML = `<div style="color: #dc2626;">❌ Error: ${data.message}</div>`;
        }
    } catch (error) {
        output.innerHTML = `<div style="color: #dc2626;">❌ Connection error</div>`;
    }
}

async function saveSimulation() {
    const output = document.getElementById('dev-output');
    output.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Testing save functionality...';
    
    // Placeholder for save functionality
    setTimeout(() => {
        output.innerHTML = '<div style="color: #10b981;">✅ Save functionality ready for Windows server integration</div>';
    }, 1000);
}

function startSimulation() {
    const mode = document.getElementById('simulation-mode').value;
    const pathogen = document.getElementById('target-pathogen').value;
    
    console.log('Starting simulation:', { mode, pathogen });
    
    // Placeholder for simulation start
    alert(`Starting ${mode} simulation${pathogen ? ' for ' + pathogen : ''}.\n\nThis will connect to the Windows server when integrated.`);
}
</script>

<?php get_footer(); ?>