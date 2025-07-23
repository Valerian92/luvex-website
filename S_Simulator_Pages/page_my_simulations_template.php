<?php
/**
 * Template for My Simulations Page
 * Template Name: My Simulations
 */

get_header(); ?>

<div class="simulations-page-container">
    <?php if (!is_user_logged_in()) : ?>
        <!-- Redirect non-authenticated users -->
        <section class="page-hero-section">
            <div class="hero-content">
                <h1><i class="fas fa-history uv-glow"></i> My Simulations</h1>
                <p>Access your saved UV simulations and continue your work.</p>
                <?php echo luvex_simulator_access_prompt_html(); ?>
            </div>
        </section>
    <?php else : 
        $current_user = wp_get_current_user(); ?>
        
        <!-- Authenticated User Interface -->
        <section class="simulations-interface-section">
            <div class="content-wrapper">
                
                <!-- Page Header -->
                <div class="page-header-card">
                    <div class="header-content">
                        <div class="header-title">
                            <h1><i class="fas fa-history"></i> My Simulations</h1>
                            <p class="header-subtitle">Manage and continue your UV simulation projects</p>
                        </div>
                        <div class="header-stats">
                            <div class="stat-card">
                                <div class="stat-number" id="total-simulations">-</div>
                                <div class="stat-label">Total Simulations</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number" id="recent-simulations">-</div>
                                <div class="stat-label">This Month</div>
                            </div>
                        </div>
                        <div class="header-actions">
                            <a href="/simulator/" class="cta-button">
                                <i class="fas fa-plus"></i> New Simulation
                            </a>
                            <button class="btn-outline" onclick="refreshSimulations()">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter and Search Controls -->
                <div class="simulation-controls-bar">
                    <div class="search-filters">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="simulation-search" placeholder="Search simulations..." />
                        </div>
                        <div class="filter-group">
                            <select id="mode-filter" class="form-control">
                                <option value="">All Modes</option>
                                <option value="surface">Surface Disinfection</option>
                                <option value="water">Water Treatment</option>
                                <option value="air">Air Purification</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select id="sort-filter" class="form-control">
                                <option value="date_desc">Newest First</option>
                                <option value="date_asc">Oldest First</option>
                                <option value="name_asc">Name A-Z</option>
                                <option value="name_desc">Name Z-A</option>
                            </select>
                        </div>
                    </div>
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Simulations Grid/List -->
                <div class="simulations-container">
                    <div id="simulations-grid" class="simulations-grid">
                        <!-- Loading placeholder -->
                        <div class="simulation-card loading-card">
                            <div class="card-header">
                                <i class="fas fa-spinner fa-spin"></i>
                                <h3>Loading simulations...</h3>
                            </div>
                            <p>Please wait while we fetch your saved simulations.</p>
                        </div>
                    </div>
                    
                    <!-- Empty State -->
                    <div id="empty-state" class="empty-state" style="display: none;">
                        <div class="empty-content">
                            <i class="fas fa-flask fa-4x"></i>
                            <h3>No simulations yet</h3>
                            <p>Start by creating your first UV simulation project.</p>
                            <a href="/simulator/" class="cta-button">
                                <i class="fas fa-plus"></i> Create First Simulation
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Sidebar -->
                <div class="quick-actions-panel">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                    <div class="action-buttons">
                        <button class="action-btn" onclick="exportAllSimulations()">
                            <i class="fas fa-download"></i>
                            <span>Export All</span>
                        </button>
                        <button class="action-btn" onclick="createTemplate()">
                            <i class="fas fa-copy"></i>
                            <span>Create Template</span>
                        </button>
                        <button class="action-btn" onclick="importSimulation()">
                            <i class="fas fa-upload"></i>
                            <span>Import</span>
                        </button>
                        <a href="/my-profile/" class="action-btn">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Simulation Details Modal -->
        <div id="simulation-modal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-title">Simulation Details</h3>
                    <button class="modal-close" onclick="closeModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- Dynamic content -->
                </div>
                <div class="modal-footer">
                    <button class="btn-outline" onclick="closeModal()">Cancel</button>
                    <button class="cta-button" id="modal-action-btn">Continue Simulation</button>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<style>
/* My Simulations Page Styles */
.simulations-page-container {
    min-height: 100vh;
    background: var(--luvex-bg-section-light);
}

.simulations-interface-section {
    padding: calc(6rem + 80px) 2rem 4rem;
}

/* Page Header */
.page-header-card {
    background: linear-gradient(135deg, var(--luvex-dark-blue), var(--luvex-accent-blue));
    color: var(--luvex-text-on-dark);
    padding: 2.5rem;
    border-radius: 20px;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.page-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 100%;
    background: radial-gradient(circle, rgba(109, 213, 237, 0.2) 0%, transparent 70%);
    pointer-events: none;
}

.header-content {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 2rem;
    align-items: center;
    position: relative;
    z-index: 2;
}

.header-title h1 {
    margin: 0 0 0.5rem 0;
    font-size: 2.5rem;
}

.header-subtitle {
    margin: 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.header-stats {
    display: flex;
    gap: 1rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.15);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--luvex-bright-cyan);
    display: block;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.25rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

/* Controls Bar */
.simulation-controls-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--luvex-border-color);
}

.search-filters {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex: 1;
}

.search-box {
    position: relative;
    flex: 1;
    max-width: 300px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--luvex-text-muted-light);
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--luvex-border-color);
    border-radius: 8px;
    background: #ffffff;
    color: var(--luvex-text-on-light);
}

.search-box input:focus {
    outline: none;
    border-color: var(--luvex-accent-blue);
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.filter-group {
    min-width: 150px;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.view-btn {
    padding: 0.75rem;
    background: var(--luvex-bg-section-alt);
    border: 1px solid var(--luvex-border-color);
    border-radius: 8px;
    color: var(--luvex-text-muted-light);
    cursor: pointer;
    transition: all 0.3s ease;
}

.view-btn.active, .view-btn:hover {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

/* Simulations Layout */
.simulations-container {
    display: grid;
    grid-template-columns: 1fr 250px;
    gap: 2rem;
}

.simulations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.simulations-grid.list-view {
    grid-template-columns: 1fr;
}

/* Simulation Cards */
.simulation-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--luvex-border-color);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.simulation-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    border-color: var(--luvex-accent-blue);
}

.simulation-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--luvex-accent-blue);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.simulation-card:hover::before {
    opacity: 1;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.card-header i {
    color: var(--luvex-accent-blue);
    font-size: 1.25rem;
}

.card-header h3 {
    margin: 0;
    color: var(--luvex-text-on-light);
    font-size: 1.1rem;
    flex: 1;
}

.card-meta {
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: var(--luvex-text-muted-light);
}

.card-meta .meta-item {
    display: flex;
    justify-content: space-between;
    margin: 0.25rem 0;
}

.card-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.card-action-btn {
    flex: 1;
    padding: 0.5rem 1rem;
    border: 1px solid var(--luvex-border-color);
    background: var(--luvex-bg-section-alt);
    color: var(--luvex-text-on-light);
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    text-decoration: none;
}

.card-action-btn:hover {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

.card-action-btn.primary {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

.card-action-btn.primary:hover {
    background: var(--luvex-bright-cyan);
    border-color: var(--luvex-bright-cyan);
}

/* List View Styles */
.simulations-grid.list-view .simulation-card {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 1rem;
    align-items: center;
    padding: 1rem 1.5rem;
}

.simulations-grid.list-view .card-header {
    margin: 0;
}

.simulations-grid.list-view .card-meta {
    margin: 0;
    display: flex;
    gap: 2rem;
}

.simulations-grid.list-view .card-actions {
    margin: 0;
    flex-shrink: 0;
}

/* Quick Actions Panel */
.quick-actions-panel {
    background: #ffffff;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--luvex-border-color);
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.quick-actions-panel h3 {
    margin: 0 0 1rem 0;
    color: var(--luvex-text-on-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-btn {
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
    text-decoration: none;
}

.action-btn:hover {
    background: var(--luvex-accent-blue);
    color: var(--luvex-text-on-dark);
    border-color: var(--luvex-accent-blue);
}

/* Empty State */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
}

.empty-content i {
    color: var(--luvex-text-muted-light);
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-content h3 {
    color: var(--luvex-text-on-light);
    margin-bottom: 1rem;
    font-size: 1.8rem;
}

.empty-content p {
    color: var(--luvex-text-muted-light);
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-content {
    background: #ffffff;
    border-radius: 16px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow: auto;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--luvex-border-color);
}

.modal-header h3 {
    margin: 0;
    color: var(--luvex-text-on-light);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--luvex-text-muted-light);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.modal-close:hover {
    background: var(--luvex-bg-section-alt);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1.5rem;
    border-top: 1px solid var(--luvex-border-color);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .simulations-container {
        grid-template-columns: 1fr;
    }
    
    .quick-actions-panel {
        position: static;
        order: -1;
    }
    
    .action-buttons {
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .action-btn {
        flex: 1;
        min-width: 150px;
    }
}

@media (max-width: 768px) {
    .header-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        text-align: center;
    }
    
    .header-stats {
        justify-content: center;
    }
    
    .simulation-controls-bar {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .search-filters {
        flex-direction: column;
        align-items: stretch;
    }
    
    .simulations-grid {
        grid-template-columns: 1fr;
    }
    
    .view-toggle {
        align-self: center;
    }
}
</style>

<script>
// My Simulations JavaScript
let currentSimulations = [];
let filteredSimulations = [];

document.addEventListener('DOMContentLoaded', function() {
    initializeSimulationsPage();
    loadUserSimulations();
});

function initializeSimulationsPage() {
    // Search functionality
    const searchInput = document.getElementById('simulation-search');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(filterSimulations, 300));
    }
    
    // Filter controls
    const modeFilter = document.getElementById('mode-filter');
    const sortFilter = document.getElementById('sort-filter');
    
    if (modeFilter) modeFilter.addEventListener('change', filterSimulations);
    if (sortFilter) sortFilter.addEventListener('change', filterSimulations);
    
    // View toggle
    const viewButtons = document.querySelectorAll('.view-btn');
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            viewButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            toggleView(this.dataset.view);
        });
    });
}

async function loadUserSimulations() {
    const grid = document.getElementById('simulations-grid');
    const emptyState = document.getElementById('empty-state');
    const totalCount = document.getElementById('total-simulations');
    const recentCount = document.getElementById('recent-simulations');
    
    try {
        const response = await fetch('/wp-json/luvex/v1/simulator-data');
        const data = await response.json();
        
        if (data.success && data.data.simulations) {
            currentSimulations = data.data.simulations;
            filteredSimulations = [...currentSimulations];
            
            // Update stats
            if (totalCount) totalCount.textContent = currentSimulations.length;
            if (recentCount) {
                const thisMonth = currentSimulations.filter(sim => {
                    const simDate = new Date(sim.created_at);
                    const now = new Date();
                    return simDate.getMonth() === now.getMonth() && 
                           simDate.getFullYear() === now.getFullYear();
                }).length;
                recentCount.textContent = thisMonth;
            }
            
            if (currentSimulations.length === 0) {
                grid.style.display = 'none';
                emptyState.style.display = 'block';
            } else {
                grid.style.display = 'grid';
                emptyState.style.display = 'none';
                renderSimulations(filteredSimulations);
            }
        } else {
            showErrorState(grid, 'Failed to load simulations');
        }
    } catch (error) {
        console.error('Error loading simulations:', error);
        showErrorState(grid, 'Connection error');
    }
}

function renderSimulations(simulations) {
    const grid = document.getElementById('simulations-grid');
    
    if (simulations.length === 0) {
        grid.innerHTML = `
            <div class="simulation-card">
                <div class="card-header">
                    <i class="fas fa-search"></i>
                    <h3>No simulations found</h3>
                </div>
                <p>Try adjusting your search or filter criteria.</p>
            </div>
        `;
        return;
    }
    
    grid.innerHTML = simulations.map(sim => `
        <div class="simulation-card" data-simulation-id="${sim.id}">
            <div class="card-header">
                <i class="fas fa-${getSimulationIcon(sim.mode)}"></i>
                <h3>${sim.simulation_name || 'Unnamed Simulation'}</h3>
            </div>
            <div class="card-meta">
                <div class="meta-item">
                    <strong>Mode:</strong> 
                    <span>${sim.mode || 'Unknown'}</span>
                </div>
                <div class="meta-item">
                    <strong>Created:</strong> 
                    <span>${formatDate(sim.created_at)}</span>
                </div>
                <div class="meta-item">
                    <strong>Last Modified:</strong> 
                    <span>${formatDate(sim.updated_at || sim.created_at)}</span>
                </div>
            </div>
            <div class="card-actions">
                <button class="card-action-btn primary" onclick="openSimulation('${sim.id}')">
                    <i class="fas fa-play"></i> Continue
                </button>
                <button class="card-action-btn" onclick="viewSimulationDetails('${sim.id}')">
                    <i class="fas fa-eye"></i> Details
                </button>
                <button class="card-action-btn" onclick="duplicateSimulation('${sim.id}')">
                    <i class="fas fa-copy"></i> Copy
                </button>
                <button class="card-action-btn" onclick="deleteSimulation('${sim.id}')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    `).join('');
}

function filterSimulations() {
    const searchTerm = document.getElementById('simulation-search').value.toLowerCase();
    const modeFilter = document.getElementById('mode-filter').value;
    const sortBy = document.getElementById('sort-filter').value;
    
    // Filter
    filteredSimulations = currentSimulations.filter(sim => {
        const matchesSearch = !searchTerm || 
            (sim.simulation_name && sim.simulation_name.toLowerCase().includes(searchTerm)) ||
            (sim.mode && sim.mode.toLowerCase().includes(searchTerm));
        
        const matchesMode = !modeFilter || sim.mode === modeFilter;
        
        return matchesSearch && matchesMode;
    });
    
    // Sort
    filteredSimulations.sort((a, b) => {
        switch (sortBy) {
            case 'date_desc':
                return new Date(b.created_at) - new Date(a.created_at);
            case 'date_asc':
                return new Date(a.created_at) - new Date(b.created_at);
            case 'name_asc':
                return (a.simulation_name || '').localeCompare(b.simulation_name || '');
            case 'name_desc':
                return (b.simulation_name || '').localeCompare(a.simulation_name || '');
            default:
                return 0;
        }
    });
    
    renderSimulations(filteredSimulations);
}

function toggleView(view) {
    const grid = document.getElementById('simulations-grid');
    if (view === 'list') {
        grid.classList.add('list-view');
    } else {
        grid.classList.remove('list-view');
    }
}

function refreshSimulations() {
    loadUserSimulations();
}

function openSimulation(simulationId) {
    // Redirect to simulator with loaded simulation
    window.location.href = `/simulator/?load=${simulationId}`;
}

function viewSimulationDetails(simulationId) {
    const simulation = currentSimulations.find(sim => sim.id === simulationId);
    if (!simulation) return;
    
    const modal = document.getElementById('simulation-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    const modalActionBtn = document.getElementById('modal-action-btn');
    
    modalTitle.textContent = simulation.simulation_name || 'Simulation Details';
    modalBody.innerHTML = `
        <div class="simulation-details">
            <div class="detail-group">
                <h4>Basic Information</h4>
                <p><strong>Name:</strong> ${simulation.simulation_name || 'Unnamed'}</p>
                <p><strong>Mode:</strong> ${simulation.mode || 'Unknown'}</p>
                <p><strong>Created:</strong> ${formatDate(simulation.created_at)}</p>
                <p><strong>Last Modified:</strong> ${formatDate(simulation.updated_at || simulation.created_at)}</p>
            </div>
            <div class="detail-group">
                <h4>Configuration</h4>
                <p><strong>Lamp Configuration:</strong> ${simulation.lamp_config ? 'Available' : 'Not configured'}</p>
                <p><strong>Environment Parameters:</strong> ${simulation.environment_params ? 'Available' : 'Not configured'}</p>
                <p><strong>Results:</strong> ${simulation.result_data ? 'Available' : 'No results yet'}</p>
            </div>
        </div>
    `;
    
    modalActionBtn.onclick = () => openSimulation(simulationId);
    modal.style.display = 'flex';
}

function duplicateSimulation(simulationId) {
    if (confirm('Create a copy of this simulation?')) {
        console.log('Duplicating simulation:', simulationId);
        // Implement duplication logic
        alert('Duplication functionality will be implemented with the Windows server integration.');
    }
}

function deleteSimulation(simulationId) {
    if (confirm('Are you sure you want to delete this simulation? This action cannot be undone.')) {
        console.log('Deleting simulation:', simulationId);
        // Implement deletion logic
        alert('Deletion functionality will be implemented with the Windows server integration.');
    }
}

function closeModal() {
    document.getElementById('simulation-modal').style.display = 'none';
}

// Quick Actions
function exportAllSimulations() {
    alert('Export functionality will be implemented with the Windows server integration.');
}

function createTemplate() {
    alert('Template creation will be implemented with the Windows server integration.');
}

function importSimulation() {
    alert('Import functionality will be implemented with the Windows server integration.');
}

// Utility Functions
function getSimulationIcon(mode) {
    const icons = {
        'surface': 'border-all',
        'water': 'tint',
        'air': 'wind',
        'Oberfläche': 'border-all',
        'Wasser': 'tint',
        'Luftkanal': 'wind'
    };
    return icons[mode] || 'flask';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function showErrorState(container, message) {
    container.innerHTML = `
        <div class="simulation-card">
            <div class="card-header">
                <i class="fas fa-exclamation-triangle" style="color: #dc2626;"></i>
                <h3>Error</h3>
            </div>
            <p>${message}</p>
            <button class="card-action-btn" onclick="refreshSimulations()">
                <i class="fas fa-sync-alt"></i> Try Again
            </button>
        </div>
    `;
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Modal close on outside click
document.addEventListener('click', function(event) {
    const modal = document.getElementById('simulation-modal');
    if (event.target === modal) {
        closeModal();
    }
});
</script>

<?php get_footer(); ?>