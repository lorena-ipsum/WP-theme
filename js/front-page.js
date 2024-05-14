document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more');  // Assurez-vous que l'ID correspond à votre bouton dans le HTML
    let page = 1;

    loadMoreBtn.addEventListener('click', function() {
        page++;
        const data = new FormData();
        data.append('action', 'load_more');
        data.append('paged', page);
        data.append('posts_per_page', 8);
        data.append('post_status', 'publish');
        data.append('post_type', 'portfolio');

        loadMoreBtn.textContent = 'Chargement...';  // Change le texte pendant le chargement

        fetch(ajaxpagination.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim().length > 0) {
                document.querySelector('.portfolio-list').insertAdjacentHTML('beforeend', data);
                document.getElementById('load-more').innerHTML = '<button id="load-more">Charger plus</button>';

            } else {
                loadMoreBtn.textContent = 'Aucun autre post à charger';
                loadMoreBtn.disabled = true;
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            loadMoreBtn.textContent = 'Charger plus';  // Restaure le texte en cas d'erreur
        });
    });
});
