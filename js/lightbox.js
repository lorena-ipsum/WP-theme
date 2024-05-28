// Initialize the lightbox and hover events
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
        var postId = portfolioItem.data('id');

        console.log("Opening lightbox for post ID:", postId);

        lightboxData.currentPostId = postId; // Set the current post ID

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
        navigateLightbox('prev');
    });

    jQuery('body').on('click', '.lightbox-next', function() {
        navigateLightbox('next');
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

// Function to navigate lightbox content
function navigateLightbox(direction) {
    var adjacentPostId = getAdjacentPostId(direction);
    if (adjacentPostId) {
        loadLightboxContent(adjacentPostId);
    }
}

// Function to load lightbox content
function loadLightboxContent(postId) {
    var portfolioItem = jQuery('.portfolio-item[data-id="' + postId + '"]');
    if (portfolioItem.length > 0) {
        var imgSrc = portfolioItem.find('.portfolio-image').attr('src');
        var reference = portfolioItem.data('reference');
        var category = portfolioItem.data('category');
        var newPostId = portfolioItem.data('id');

        console.log("Loading content for post ID:", newPostId);

        jQuery('.lightbox-modal img.lightbox-content').attr('src', imgSrc);
        jQuery('.lightbox-details .reference').text(reference);
        jQuery('.lightbox-details .category').text(category);

        // Update the current post ID in the global data
        lightboxData.currentPostId = newPostId;
    }
}

// Function to get the ID of the adjacent post
function getAdjacentPostId(direction) {
    var currentIndex = lightboxData.posts.indexOf(lightboxData.currentPostId);
    var newIndex;

    if (currentIndex === -1) {
        console.error('Current post ID not found in lightboxData.posts');
        return null;
    }

    console.log("Current index:", currentIndex);

    if (direction === 'prev') {
        newIndex = (currentIndex === 0) ? lightboxData.posts.length - 1 : currentIndex - 1;
    } else {
        newIndex = (currentIndex === lightboxData.posts.length - 1) ? 0 : currentIndex + 1;
    }

    var newPostId = lightboxData.posts[newIndex];
    console.log("New index:", newIndex, "New post ID:", newPostId);
    return newPostId;
}

// Initialize on document ready
jQuery(document).ready(function($) {
    // Initialize lightboxData with the list of portfolio post IDs
    lightboxData = {
        posts: jQuery('.portfolio-item').map(function() {
            return jQuery(this).data('id');
        }).get(),
        currentPostId: null
    };

    console.log("Initialized lightboxData with posts:", lightboxData.posts);

    initializePortfolioHoverAndLightbox();
});
