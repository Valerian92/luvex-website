<?php
/**
 * Template Name: Login Page (Modal Trigger)
 * Description: Zeigt den Hero-Bereich und öffnet das Login-Modal automatisch.
 * @package Luvex
 * @since 2.2.0
 * Last Update: 2025-08-28 23:25
 */

get_header(); ?>

<!-- Enhanced Hero Section -->
<section class="luvex-hero luvex-hero--auth luvex-hero--login">
    <div class="hero-particles">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
    </div>
    
    <div class="luvex-hero__container">
        <div class="hero-badge hero-badge--welcome">
            <i class="fa-solid fa-home"></i>
            <span>Welcome Back</span>
        </div>
        <h1 class="luvex-hero__title">
            Sign In to <span class="text-highlight">LUVEX</span>
        </h1>
        <p class="luvex-hero__subtitle">
            Continue your UV journey
        </p>
        <p class="luvex-hero__description">
            Access your UV simulator settings, saved projects, measurement history, and connect with your professional network.
        </p>
        
        <!-- Quick Access Features -->
        <div class="hero-quick-features">
            <div class="quick-feature">
                <i class="fa-solid fa-chart-line"></i>
                <span>Your Dashboard</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-bookmark"></i>
                <span>Saved Projects</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </div>
        </div>
    </div>
</section>

<!--
    Das Modal selbst wird über die footer.php geladen.
    Dieses Template öffnet das Modal nur automatisch bei Seitenaufruf.
-->

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Öffne das Modal direkt nach dem Laden der Seite, da dies die Login-Seite ist
        window.openAuthModal('login');
    });
</script>
