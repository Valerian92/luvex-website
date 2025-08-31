/**
 * LUVEX Theme - Interactive Content Accordion
 *
 * Description: Handles the expand/collapse functionality for the
 * content accordion component. Allows only one item per
 * container to be open at a time.
 * Version: 3.0 (Final for Tech-Style)
 * Author: Gemini
 * Last Update: 2025-09-01
 */
document.addEventListener('DOMContentLoaded', function () {
    const allHeaders = document.querySelectorAll('.accordion-header');

    if (allHeaders.length > 0) {
        allHeaders.forEach(header => {
            const item = header.closest('.accordion-item');

            // Initialize active items on page load by setting their max-height
            if (item && item.classList.contains('active')) {
                const content = item.querySelector('.accordion-content');
                if (content) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            }

            header.addEventListener('click', () => {
                const currentItem = header.closest('.accordion-item');
                if (!currentItem) return;

                const currentContent = currentItem.querySelector('.accordion-content');
                const isCurrentlyActive = currentItem.classList.contains('active');
                
                // Find the parent container to close only sibling items
                const container = header.closest('.accordion-container');
                if (container) {
                    container.querySelectorAll('.accordion-item').forEach(item => {
                        item.classList.remove('active');
                        const content = item.querySelector('.accordion-content');
                        if (content) {
                            content.style.maxHeight = '0';
                        }
                    });
                }

                // Toggle the clicked item
                if (!isCurrentlyActive) {
                    currentItem.classList.add('active');
                    if (currentContent) {
                        currentContent.style.maxHeight = currentContent.scrollHeight + 'px';
                    }
                }
            });
        });
    }
});

