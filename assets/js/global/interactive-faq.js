/**
 * LUVEX Theme - Interactive FAQ System
 *
 * Description: Handles the tab-like functionality for the FAQ section
 * on the UV Consulting page.
 * Version: 1.0
 * Author: Gemini
 * Last Update: 2025-08-07
 */
document.addEventListener('DOMContentLoaded', function () {
    // Select all necessary elements
    const questionButtons = document.querySelectorAll('.faq-question-btn');
    const answerPanels = document.querySelectorAll('.faq-answer-panel');

    // Check if the interactive FAQ elements exist on the page
    if (questionButtons.length > 0 && answerPanels.length > 0) {
        
        questionButtons.forEach(button => {
            button.addEventListener('click', function () {
                const targetAnswerId = this.getAttribute('data-answer');
                
                // --- Handle Button States ---
                // 1. Remove 'active' class from all buttons
                questionButtons.forEach(btn => btn.classList.remove('active'));
                
                // 2. Add 'active' class to the clicked button
                this.classList.add('active');
                
                // --- Handle Answer Panel Visibility ---
                // 1. Hide all answer panels
                answerPanels.forEach(panel => {
                    panel.classList.remove('active');
                });
                
                // 2. Show the target answer panel
                const targetPanel = document.getElementById(targetAnswerId);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            });
        });
    }
});
