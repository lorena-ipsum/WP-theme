console.log("you got it girl!");

// Fonctionnalité de menu mobile
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            const siteNavigation = document.querySelector('.main-navigation');
            const icon = this.querySelector('i');
            siteNavigation.classList.toggle('toggled');
            if (siteNavigation.classList.contains('toggled')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-x');
            } else {
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-x');
            }
        });
    }
});

// Effet de fondu pour les éléments avec la classe 'fade'
function fadeIn() {
    const elements = document.querySelectorAll('.fade');
    elements.forEach(element => {
        element.style.opacity = 1;
    });
}
document.addEventListener('DOMContentLoaded', fadeIn);
window.addEventListener('load', fadeIn);
