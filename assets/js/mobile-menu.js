document.addEventListener('DOMContentLoaded', function() {
    // Bestehender Mobile dropdown code
    const menuItemsWithChildren = document.querySelectorAll('.main-navigation .menu-item-has-children > a');
    
    menuItemsWithChildren.forEach(item => {
        item.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const parentLi = this.parentElement;
                parentLi.classList.toggle('mobile-open');
            }
        });
    });

    // NEUE Desktop Dropdown-Verbesserungen
    const dropdownItems = document.querySelectorAll('.main-navigation .menu-item-has-children');
    
    dropdownItems.forEach(item => {
        const subMenu = item.querySelector('.sub-menu');
        if (!subMenu) return;
        
        // Verhindere Dropdown außerhalb Viewport
        item.addEventListener('mouseenter', function() {
            setTimeout(() => {
                const rect = subMenu.getBoundingClientRect();
                const viewportWidth = window.innerWidth;
                
                if (rect.right > viewportWidth - 20) {
                    subMenu.style.left = 'auto';
                    subMenu.style.right = '0';
                } else {
                    subMenu.style.left = '0';
                    subMenu.style.right = 'auto';
                }
            }, 10);
        });
    });
});