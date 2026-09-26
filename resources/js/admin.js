// Bootstrap JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Admin specific JavaScript
console.log('Admin panel loaded');

// Sidebar dropdown functionality - Initialize immediately and on DOM ready
function initializeSidebarDropdowns() {
    console.log('Initializing sidebar dropdowns...');
    
    // Handle dropdown menu toggle
    const dropdownToggles = document.querySelectorAll('.sidebar-menu a.has-dropdown');
    console.log('Found dropdown toggles:', dropdownToggles.length);
    
    dropdownToggles.forEach((toggle, index) => {
        console.log('Setting up dropdown', index, toggle);
        
        // Remove any existing event listeners by cloning
        const newToggle = toggle.cloneNode(true);
        toggle.parentNode.replaceChild(newToggle, toggle);
        
        newToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Dropdown clicked!');
            
            const parentLi = this.closest('li.has-dropdown');
            const dropdownMenu = parentLi ? parentLi.querySelector('.dropdown-menu') : null;
            
            console.log('Parent li:', parentLi);
            console.log('Dropdown menu:', dropdownMenu);
            
            if (!parentLi || !dropdownMenu) {
                console.error('Could not find parent or dropdown menu');
                return;
            }
            
            // Close all other dropdowns
            document.querySelectorAll('.sidebar-menu li.has-dropdown').forEach(item => {
                if (item !== parentLi) {
                    const link = item.querySelector('a.has-dropdown');
                    const menu = item.querySelector('.dropdown-menu');
                    if (link) link.classList.remove('active');
                    if (menu) menu.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            this.classList.toggle('active');
            dropdownMenu.classList.toggle('show');
            
            console.log('Toggled! Active:', this.classList.contains('active'), 'Show:', dropdownMenu.classList.contains('show'));
        });
    });
    
    // Keep dropdown open if a child link is active
    document.querySelectorAll('.sidebar-menu .dropdown-menu a').forEach(link => {
        if (link.classList.contains('active')) {
            const parentLi = link.closest('li.has-dropdown');
            if (parentLi) {
                const toggleLink = parentLi.querySelector('a.has-dropdown');
                const menu = parentLi.querySelector('.dropdown-menu');
                if (toggleLink) toggleLink.classList.add('active');
                if (menu) menu.classList.add('show');
            }
        }
    });
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeSidebarDropdowns);
} else {
    // DOM is already ready, initialize immediately
    initializeSidebarDropdowns();
}

// Also try after a short delay as a fallback
setTimeout(initializeSidebarDropdowns, 100);

