console.log("Wow, quelle belle lightbox!");
// Initialiser les événements de la lightbox et du survol
function initializePortfolioHoverAndLightbox() {
    // Désactiver les anciens événements pour éviter les doublons
    jQuery('body').off('click', '.expand-icon');
    jQuery('body').off('click', '.close-lightbox');
    jQuery('.portfolio-item a').off('click');

    // Événement pour ouvrir la lightbox
    jQuery('body').on('click', '.expand-icon', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var portfolioItem = jQuery(this).closest('.portfolio-item');
        var imgSrc = portfolioItem.find('.portfolio-image').attr('src');
        var reference = portfolioItem.data('reference');
        var category = portfolioItem.data('category');
        var postId = portfolioItem.data('id');

        console.log("Opening lightbox for post ID:", postId);

        lightboxData.currentPostId = postId; // Définir l'ID du post actuel

        // Mettre à jour le contenu de la lightbox
        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-details .reference').text(reference);
        jQuery('.lightbox-details .category').text(category);
        jQuery('.lightbox-modal').fadeIn();
    });

    // Événement pour fermer la lightbox
    jQuery('body').on('click', '.close-lightbox', function() {
        jQuery('.lightbox-modal').fadeOut(function() {
            jQuery(this).find('img.lightbox-content').attr('src', '');
            jQuery(this).find('.lightbox-details .reference').text('');
            jQuery(this).find('.lightbox-details .category').text('');
        });
    });

    // Événement pour naviguer vers l'image précédente dans la lightbox
    jQuery('body').on('click', '.lightbox-prev', function() {
        navigateLightbox('prev');
    });

    // Événement pour naviguer vers l'image suivante dans la lightbox
    jQuery('body').on('click', '.lightbox-next', function() {
        navigateLightbox('next');
    });

    // Optionnel: Fermer la lightbox en cliquant à l'extérieur du contenu
    jQuery('.lightbox-modal').on('click', function(e) {
        if (e.target === this) {
            jQuery(this).fadeOut(function() {
                jQuery(this).find('img.lightbox-content').attr('src', '');
                jQuery(this).find('.lightbox-details .reference').text('');
                jQuery(this).find('.lightbox-details .category').text('');
            });
        }
    });

    // Assurer que la lightbox est cachée au chargement de la page
    jQuery('.lightbox-modal').hide();
}

// Fonction pour naviguer dans le contenu de la lightbox
function navigateLightbox(direction) {
    var adjacentPostId = getAdjacentPostId(direction);
    if (adjacentPostId) {
        loadLightboxContent(adjacentPostId);
    }
}

// Fonction pour charger le contenu de la lightbox
function loadLightboxContent(postId) {
    var portfolioItem = jQuery('.portfolio-item[data-id="' + postId + '"]');
    if (portfolioItem.length > 0) {
        var imgSrc = portfolioItem.find('.portfolio-image').attr('src');
        var reference = portfolioItem.data('reference');
        var category = portfolioItem.data('category');
        var newPostId = portfolioItem.data('id');

        console.log("Loading content for post ID:", newPostId);

        // Mettre à jour le contenu de la lightbox
        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-details .reference').text(reference);
        jQuery('.lightbox-details .category').text(category);

        // Mettre à jour l'ID du post actuel dans les données globales
        lightboxData.currentPostId = newPostId;
    }
}

// Fonction pour obtenir l'ID du post adjacent
function getAdjacentPostId(direction) {
    var currentIndex = lightboxData.posts.indexOf(lightboxData.currentPostId);
    var newIndex;

    if (currentIndex === -1) {
        console.error('Current post ID not found in lightboxData.posts');
        return null;
    }

    console.log("Current index:", currentIndex);

    // Calculer le nouvel index basé sur la direction
    if (direction === 'prev') {
        newIndex = (currentIndex === 0) ? lightboxData.posts.length - 1 : currentIndex - 1;
    } else {
        newIndex = (currentIndex === lightboxData.posts.length - 1) ? 0 : currentIndex + 1;
    }

    var newPostId = lightboxData.posts[newIndex];
    console.log("New index:", newIndex, "New post ID:", newPostId);
    return newPostId;
}

// Initialiser au chargement du document
jQuery(document).ready(function($) {
    // Initialiser lightboxData avec la liste des IDs de posts du portfolio
    lightboxData = {
        posts: jQuery('.portfolio-item').map(function() {
            return jQuery(this).data('id');
        }).get(),
        currentPostId: null
    };

    console.log("Initialized lightboxData with posts:", lightboxData.posts);

    initializePortfolioHoverAndLightbox();
});
