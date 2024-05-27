// Initialisation de la lightbox et des survols
function initializePortfolioHoverAndLightbox() {
    jQuery('body').off('click', '.expand-icon');
    jQuery('body').off('click', '.close-lightbox');
    jQuery('.portfolio-item a').off('click');

    jQuery('body').on('click', '.expand-icon', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var imgSrc = jQuery(this).closest('.portfolio-item').find('.portfolio-image').attr('src');
        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-modal').fadeIn();
    });

    jQuery('body').on('click', '.close-lightbox', function() {
        jQuery('.lightbox-modal').fadeOut(function() {
            jQuery(this).find('img.lightbox-content').attr('src', '');
        });
    });

    jQuery('body').on('click', '.portfolio-item a', function(e) {
        if (jQuery(e.target).is('.expand-icon')) {
            e.preventDefault();
        } else if (jQuery(e.target).is('.view-icon')) {
            window.location.href = jQuery(this).attr('href');
        }
    });
}

// Initialisation au chargement du document
jQuery(document).ready(function($) {
    initializePortfolioHoverAndLightbox();
});
