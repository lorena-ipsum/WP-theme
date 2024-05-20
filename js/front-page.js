// Chargement initial des catégories et formats, et gestion de la pagination infinie
document.addEventListener('DOMContentLoaded', function() {
    fetchCategoriesAndFormats();
    setupLoadMore();
});

function fetchCategoriesAndFormats() {
    // Charger les catégories
    fetch(`${wpApiSettings.root}wp/v2/categories`)
        .then(response => response.json())
        .then(categories => {
            const categorySelect = document.getElementById('category-filter');
            categories.forEach(category => {
                let option = new Option(category.name, category.id);
                categorySelect.appendChild(option);
            });
        });

    // Charger les formats
    fetch(`${wpApiSettings.root}wp/v2/formats`)
        .then(response => response.json())
        .then(formats => {
            const formatSelect = document.getElementById('format-filter');
            formats.forEach(format => {
                let option = new Option(format.name, format.id);
                formatSelect.appendChild(option);
            });
        });
}

function setupLoadMore() {
    const loadMoreBtn = document.getElementById('load-more');
    let page = 1;

    loadMoreBtn.addEventListener('click', function() {
        page++;
        const data = new FormData();
        data.append('action', 'load_more');
        data.append('paged', page);
        data.append('posts_per_page', 8);
        data.append('post_status', 'publish');
        data.append('post_type', 'portfolio');

        loadMoreBtn.textContent = 'Chargement...';

        fetch(ajaxpagination.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim().length > 0) {
                document.querySelector('.portfolio-list').insertAdjacentHTML('beforeend', data);
                loadMoreBtn.innerHTML = '<button id="load-more">Charger plus</button>';
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

// Logique pour appliquer les filtres
function applyFilters() {
    let category = document.getElementById('category-filter').value;
    let format = document.getElementById('format-filter').value;
    let sortOrder = document.getElementById('sort-filter').value;

    let url = `${wpApiSettings.root}wp/v2/portfolio?_embed&categories=${category}&formats=${format}&order=${sortOrder}`;

    fetch(url)
        .then(response => response.json())
        .then(posts => {
            document.querySelector('.portfolio-list').innerHTML = '';
            posts.forEach(post => {
                let postHtml = `<div class="portfolio-item">
                    <a href="${post.link}">
                        <img src="${post.featured_media_src_url}" class="portfolio-image">
                    </a>
                </div>`;
                document.querySelector('.portfolio-list').insertAdjacentHTML('beforeend', postHtml);
            });
        });
}
