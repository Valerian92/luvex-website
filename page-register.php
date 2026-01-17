<?php
/**
 * Template Name: Register Page (Modal Trigger)
 * Description: Zeigt den Hero-Bereich und öffnet das Register-Modal automatisch.
 * @package Luvex
 * @since 3.1.0
 * Last Update: 2025-08-28 23:25
 */

get_header(); ?>

<!-- Enhanced Hero Section (neues, einheitliches Styling) -->
<section class="luvex-hero luvex-hero--auth luvex-hero--register">
    <div class="hero-particles">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
        <div class="particle particle-4"></div>
    </div>
    
    <div class="luvex-hero__container">
        <div class="hero-badge hero-badge--welcome">
            <i class="fa-solid fa-user-plus"></i>
            <span>Join Us Today</span>
        </div>
        <h1 class="luvex-hero__title">
            Create Your <span class="text-highlight">LUVEX</span> Account
        </h1>
        <p class="luvex-hero__subtitle">
            Unlock the full power of our UV technology tools and community.
        </p>
        <p class="luvex-hero__description">
            Access your UV simulator settings, saved projects, measurement history, and connect with your professional network.
        </p>
        
        <!-- Quick Access Features -->
        <div class="hero-quick-features">
            <div class="quick-feature">
                <i class="fa-solid fa-sun"></i>
                <span>UV Simulator</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-microscope"></i>
                <span>Strip Analyzer</span>
            </div>
            <div class="quick-feature">
                <i class="fa-solid fa-users"></i>
                <span>Community Access</span>
            </div>
        </div>
    </div>
</section>

<!--
    Das Modal selbst wird über die footer.php geladen.
    Dieses Template öffnet das Modal nur automatisch bei Seitenaufruf.
-->

<?php get_footer(); ?>
