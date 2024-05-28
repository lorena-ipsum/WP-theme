// Initialisation de la lightbox et des survols
function initializePortfolioHoverAndLightbox() {
    jQuery('body').off('click', '.expand-icon');
    jQuery('body').off('click', '.close-lightbox');
    jQuery('.portfolio-item a').off('click');

    jQuery('body').on('click', '.expand-icon', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var portfolioItem = jQuery(this).closest('.portfolio-item');
        var imgSrc = portfolioItem.find('.portfolio-image').attr('src');
        var reference = portfolioItem.data('reference');
        var category = portfolioItem.data('category');

        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-details .reference').text(reference);
        jQuery('.lightbox-details .category').text(category);
        jQuery('.lightbox-modal').fadeIn();
    });

    jQuery('body').on('click', '.close-lightbox', function() {
        jQuery('.lightbox-modal').fadeOut(function() {
            jQuery(this).find('img.lightbox-content').attr('src', '');
            jQuery(this).find('.lightbox-details .reference').text('');
            jQuery(this).find('.lightbox-details .category').text('');
        });
    });

    jQuery('body').on('click', '.lightbox-prev', function() {
        var prevUrl = getAdjacentPostUrl('prev');
        if (prevUrl) {
            loadLightboxContent(prevUrl);
        }
    });

    jQuery('body').on('click', '.lightbox-next', function() {
        var nextUrl = getAdjacentPostUrl('next');
        if (nextUrl) {
            loadLightboxContent(nextUrl);
        }
    });

    // Optional: Close lightbox when clicking outside of the content
    jQuery('.lightbox-modal').on('click', function(e) {
        if (e.target === this) {
            jQuery(this).fadeOut(function() {
                jQuery(this).find('img.lightbox-content').attr('src', '');
                jQuery(this).find('.lightbox-details .reference').text('');
                jQuery(this).find('.lightbox-details .category').text('');
            });
        }
    });

    // Ensure lightbox is hidden on page load
    jQuery('.lightbox-modal').hide();
}

// Function to load lightbox content
function loadLightboxContent(url) {
    jQuery.get(url, function(data) {
        var newContent = jQuery(data).find('.portfolio-item');
        var imgSrc = newContent.find('.portfolio-image').attr('src');
        var reference = newContent.data('reference');
        var category = newContent.data('category');
        var newPostId = newContent.data('id');

        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-details .reference').text(reference);
        jQuery('.lightbox-details .category').text(category);

        // Update the current post ID in the global data
        lightboxData.currentPostId = newPostId;
    });
}

// Function to get the URL of the adjacent post
function getAdjacentPostUrl(direction) {
    var currentIndex = lightboxData.posts.indexOf(lightboxData.currentPostId);
    var newIndex;

    if (currentIndex === -1) {
        console.error('Current post ID not found in lightboxData.posts');
        return null;
    }

    if (direction === 'prev') {
        newIndex = (currentIndex === 0) ? lightboxData.posts.length - 1 : currentIndex - 1;
    } else {
        newIndex = (currentIndex === lightboxData.posts.length - 1) ? 0 : currentIndex + 1;
    }

    var newPostId = lightboxData.posts[newIndex];
    return newPostId ? '/?p=' + newPostId : null; // Assumes the permalink structure includes the post ID
}

// Initialisation au chargement du document
jQuery(document).ready(function($) {
    initializePortfolioHoverAndLightbox();
});
