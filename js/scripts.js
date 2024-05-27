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

// Initialisation de la lightbox et des survols
function initializePortfolioHoverAndLightbox() {
    // Suppression des événements existants pour éviter la duplication
    jQuery('body').off('click', '.expand-icon');
    jQuery('body').off('click', '.close-lightbox');
    jQuery('.portfolio-item a').off('click');

    // Ouverture de la lightbox seulement si on clique sur l'icône d'agrandissement
    jQuery('body').on('click', '.expand-icon', function(e) {
        e.preventDefault(); // Empêche le comportement de lien normal
        e.stopPropagation(); // Arrête la propagation pour éviter le lien parent de s'activer
        var imgSrc = jQuery(this).closest('.portfolio-item').find('.portfolio-image').attr('src');
        jQuery('body').append(`<div class="lightbox-modal"><span class="close-lightbox">&times;</span><img src="${imgSrc}" alt="" class="lightbox-content"></div>`);
        jQuery('.lightbox-modal').fadeIn();
    });

    // Fermeture de la lightbox
    jQuery('body').on('click', '.close-lightbox', function() {
        jQuery('.lightbox-modal').fadeOut(function() {
            jQuery(this).remove();
        });
    });

    // Assurer que les clics sur les icônes et les images redirigent correctement
    jQuery('.portfolio-item a').on('click', function(e) {
        if (jQuery(e.target).is('.expand-icon')) {
            e.preventDefault(); // Empêche le comportement de lien normal si clic sur icône d'agrandissement
        } else if (jQuery(e.target).is('.view-icon')) {
            // Le clic sur l'icône de vue doit également rediriger correctement
            window.location.href = jQuery(this).attr('href');
        }
    });
}

// Initialisation au chargement du document
jQuery(document).ready(function($) {
    initializePortfolioHoverAndLightbox();
});
