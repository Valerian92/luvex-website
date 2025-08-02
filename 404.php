<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Luvex
 */

get_header();
?>

<main id="main" class="site-main">

    <!-- 404 Hero Section -->
    <section class="error404-hero">
        <div class="error404-hero-content">
            <div class="error404-visual">
                <div class="background-text">404</div>
                <div class="icon-wrapper">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <h1 class="entry-title">Page Not Found</h1>
            <p class="intro-text">
                The UV knowledge you're looking for seems to have wandered off the light path. 
                Let's get you back on track.
            </p>
            
            <!-- Search Form -->
            <form role="search" method="get" class="error404-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" placeholder="Search UV topics, applications, or technologies..." value="<?php echo get_search_query(); ?>" name="s">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </section>

    <!-- Quick Navigation Section -->
    <section class="error404-section bg-light">
        <div class="error404-section-container">
            <h2 class="error404-section-title">Popular Resources</h2>
            <p class="error404-section-subtitle">Perhaps one of these popular sections has what you're looking for.</p>
            
            <div class="quick-nav-grid">
                
                <a href="<?php echo esc_url( home_url( '/uv-knowledge' ) ); ?>" class="quick-nav-card">
                    <div class="icon-container" style="background-color: var(--luvex-accent-blue);"><i class="fas fa-atom" style="color: white;"></i></div>
                    <h3 class="card-title">UV Fundamentals</h3>
                    <p class="card-description">Learn the physics and engineering principles behind UV technology.</p>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/uv-equipment' ) ); ?>" class="quick-nav-card">
                    <div class="icon-container" style="background-color: var(--luvex-cyan);"><i class="fas fa-industry" style="color: var(--luvex-dark-blue);"></i></div>
                    <h3 class="card-title">Technology Hub</h3>
                    <p class="card-description">Discover UV solutions for water, air, surfaces, and curing applications.</p>
                </a>
                
                <a href="<?php echo esc_url( home_url( '/uv-simulator' ) ); ?>" class="quick-nav-card">
                    <div class="icon-container" style="background-color: var(--luvex-accent-blue);"><i class="fas fa-calculator" style="color: white;"></i></div>
                    <h3 class="card-title">UV Simulator & Tools</h3>
                    <p class="card-description">Interactive tools for UV system design and dose calculations.</p>
                </a>
                
            </div>
        </div>
    </section>

    <!-- Help Section -->
    <section class="error404-section">
        <div class="error404-section-container">
            <div class="help-box">
                <h2 class="error404-section-title" style="color: white;">Still Can't Find It?</h2>
                <p class="error404-section-subtitle" style="color: #e0e6f1;">Our UV experts are here to help. Get personalized assistance finding the information you need.</p>
                
                <div class="buttons-container">
                    <a href="<?php echo esc_url( home_url( '/booking' ) ); ?>" class="btn btn-primary">
                        <i class="fas fa-comments"></i> Ask an Expert
                    </a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Return Home
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
?>
