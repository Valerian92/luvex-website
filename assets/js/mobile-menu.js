document.addEventListener('DOMContentLoaded', function() {
    // Mobile dropdown toggle
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
});