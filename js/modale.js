console.log('fichier modale dale dale');

// Fonction pour gérer l'affichage du menu burger
function toggleMenu() {
    const siteNavigation = document.querySelector('.main-navigation');
    const menuToggle = document.querySelector('.menu-toggle');
    const icon = document.querySelector('.menu-toggle .icon i');

    const isOpen = siteNavigation.classList.contains('toggled');
    siteNavigation.classList.toggle('toggled');

    // Mise à jour de l'icône avec Font Awesome en changeant les classes
    if (isOpen) {
        icon.classList.remove('fa-x');
        icon.classList.add('fa-bars');
        menuToggle.setAttribute('aria-expanded', 'false');
    } else {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-x');
        menuToggle.setAttribute('aria-expanded', 'true');
    }
}

// Ajoute les écouteurs d'événements une fois que le DOM est chargé
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }
});

// Fonction pour gérer les sous-menus
function toggleSubMenu(button) {
    const parentLi = button.parentNode;
    const subMenu = parentLi.querySelector('.sub-menu');
    subMenu.classList.toggle('open');
}

// Fonction pour l'effet de fondu
function fadeIn() {
    const elements = document.querySelectorAll('.fade');
    elements.forEach(element => {
        element.style.opacity = 1;
    });
}

// Ajoute les écouteurs d'événements une fois que le DOM est chargé
document.addEventListener('DOMContentLoaded', function() {
    // Code pour initialiser le menu burger et les sous-menus
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    const menuItems = document.querySelectorAll('li.menu-item-has-children');
    menuItems.forEach(function(el) {
        const button = el.querySelector('button');
        if (button) {
            button.addEventListener('click', function() {
                toggleSubMenu(button);
            });
        }
    });

// Effet de fondu pour les éléments avec la classe 'fade'
    fadeIn();
});

// Effet de fondu au chargement complet de la page
window.addEventListener('load', fadeIn);

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('contact-modal');
    const closeModalButton = document.getElementById('close-modal-button');
    
    // Ouvrir la modale
    document.querySelectorAll('a[href="#contact"]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            modal.style.display = 'flex';
        });
    });

// Fermer la modale
    closeModalButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

// Fermer la modale si on clique à l'extérieur du contenu
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});