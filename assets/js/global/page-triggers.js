/**
 * Page Triggers - Zentrale Script-Datei für seitenspezifische Auto-Trigger
 *
 * Ersetzt inline Scripts aus page-login.php, page-register.php und page-about.php
 * @package Luvex
 * @since 4.7.0
 */

document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;

    // Login Page - Modal Trigger
    if (body.classList.contains('page-template-page-login')) {
        window.openAuthModal && window.openAuthModal('login');
    }

    // Register Page - Modal Trigger
    if (body.classList.contains('page-template-page-register')) {
        window.openAuthModal && window.openAuthModal('register');
    }

    // About Page - Custom Cursor
    if (body.classList.contains('page-template-page-about')) {
        initAboutCursor();
    }
});

/**
 * Initialisiert den Custom Cursor für die About-Page
 */
function initAboutCursor() {
    const hero = document.querySelector('.about-hero');
    const header = document.querySelector('.site-header');
    const customCursor = document.querySelector('.custom-about-cursor');

    if (!hero || !customCursor || !header) return;

    const handleMouseMove = (e) => {
        customCursor.style.left = e.clientX + 'px';
        customCursor.style.top = e.clientY + 'px';
    };

    const handleMouseEnter = (e) => {
        if (e.target.closest('.about-hero') || e.target.closest('.site-header')) {
            document.body.classList.add('custom-cursor-active');
            if (e.target.closest('.site-header')) {
                customCursor.classList.add('header-hover');
            }
        }
    };

    const handleMouseLeave = (e) => {
        if (!e.relatedTarget || (!e.relatedTarget.closest('.about-hero') && !e.relatedTarget.closest('.site-header'))) {
            document.body.classList.remove('custom-cursor-active');
        }
        if (!e.relatedTarget || !e.relatedTarget.closest('.site-header')) {
            customCursor.classList.remove('header-hover');
        }
    };

    document.addEventListener('mousemove', handleMouseMove);
    hero.addEventListener('mouseenter', handleMouseEnter);
    hero.addEventListener('mouseleave', handleMouseLeave);
    header.addEventListener('mouseenter', handleMouseEnter);
    header.addEventListener('mouseleave', handleMouseLeave);
}
