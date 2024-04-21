// Récupérez l'élément du lien "Contact" par son ID
const contactLink = document.getElementById('menu-item-53');

// Récupérez l'élément de la modale de contact par son ID
const contactModal = document.getElementById('contact-modal');

// Récupérez l'élément du bouton de fermeture de la modale
const closeModalButton = document.getElementById('close-modal-button');

// Écoutez l'événement de clic sur le lien "Contact"
contactLink.addEventListener('click', () => {
    // Ajoutez une classe pour afficher la modale
    contactModal.classList.add('show-modal');
});

// Écoutez l'événement de clic sur le bouton de fermeture
closeModalButton.addEventListener('click', () => {
    // Supprimez la classe pour masquer la modale
    contactModal.classList.remove('show-modal');
});
