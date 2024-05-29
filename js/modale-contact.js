console.log("Hey, je suis ta modale de contact de la nav bar");

// *** MODALE DE CONTACT ***
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

    // Fermer la modale si on clique à l'extérieur du contenu
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
