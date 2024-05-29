console.log("Hola, je suis ta front-page, cheri!");

document.addEventListener('DOMContentLoaded', function() {
    fetchCategoriesAndFormats();
    setupLoadMore();
    setupFilters();
    initializePortfolioHoverAndLightbox(); 
});

// Fonction pour récupérer les catégories et formats depuis l'API WordPress
function fetchCategoriesAndFormats() {
    fetch(`${wpApiSettings.root}wp/v2/categorie`, {
        headers: {
            'X-WP-Nonce': wpApiSettings.nonce
        }
    })
    .then(response => response.json())
    .then(categories => {
        const categorySelect = document.getElementById('category-filter');
        categories.forEach(category => {
            let option = new Option(category.name, category.id);
            categorySelect.appendChild(option);
        });
    });

    fetch(`${wpApiSettings.root}wp/v2/formats`, {
        headers: {
            'X-WP-Nonce': wpApiSettings.nonce
        }
    })
    .then(response => response.json())
    .then(formats => {
        const formatSelect = document.getElementById('format-filter');
        formats.forEach(format => {
            let option = new Option(format.name, format.id);
            formatSelect.appendChild(option);
        });
    });
}

// Fonction pour configurer le bouton "Charger plus"
function setupLoadMore() {
    const loadMoreBtn = document.querySelector('#load-more button');
    let page = 1;

    loadMoreBtn.addEventListener('click', function() {
        page++;
        const data = new FormData();
        data.append('action', 'load_more');
        data.append('paged', page);
        data.append('_ajax_nonce', ajaxpagination.nonce);

        loadMoreBtn.textContent = 'Chargement...';

        fetch(ajaxpagination.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(response => {
            if (response.success) {
                document.querySelector('.portfolio-list').insertAdjacentHTML('beforeend', response.data);
                loadMoreBtn.textContent = 'Charger plus';
                // Réinitialiser les fonctionnalités de survol et de lightbox
                initializePortfolioHoverAndLightbox();
                updateLightboxData();
            } else {
                loadMoreBtn.textContent = 'Aucun autre post à charger';
                loadMoreBtn.disabled = true;
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            loadMoreBtn.textContent = 'Charger plus';
        });
    });
}

// Fonction pour configurer les filtres
function setupFilters() {
    const filters = document.querySelectorAll('#category-filter, #format-filter, #sort-filter');
    filters.forEach(filter => {
        filter.addEventListener('change', applyFilters);
    });
}

// Fonction pour appliquer les filtres sélectionnés
function applyFilters() {
    let category = document.getElementById('category-filter').value;
    let format = document.getElementById('format-filter').value;
    let sortOrder = document.getElementById('sort-filter').value;

    const data = new FormData();
    data.append('action', 'apply_filters');
    data.append('category', category);
    data.append('format', format);
    data.append('order', sortOrder);
    data.append('_ajax_nonce', ajaxpagination.nonce);

    fetch(ajaxpagination.ajaxurl, {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(response => {
        if (response.success) {
            document.querySelector('.portfolio-list').innerHTML = response.data;
            // Réinitialiser les fonctionnalités de survol et de lightbox
            initializePortfolioHoverAndLightbox();
            updateLightboxData();
        } else {
            document.querySelector('.portfolio-list').innerHTML = '<p>Aucun post trouvé pour les filtres sélectionnés.</p>';
        }
    })
    .catch(error => {
        console.error('Erreur AJAX:', error);
    });
}

// Fonction pour mettre à jour les données de la lightbox
function updateLightboxData() {
    lightboxData.posts = jQuery('.portfolio-item').map(function() {
        return jQuery(this).data('id');
    }).get();

    console.log("Updated lightboxData with posts:", lightboxData.posts);
}
