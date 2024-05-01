console.log('you got it girl');

// CATALOGUE

// Sélection des éléments et ajout d'événements
/*
document.querySelectorAll('.related-images img').forEach(image => {
    image.addEventListener('click', () => {
       //Création d'un élément modal
        const modal = document.createElement('div');
        //Styles du modal A METRE SUR CSS APRES
        modal.style.position = 'fixed';
        modal.style.left = 0;
        modal.style.top = 0;
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0,0,0,0.8)';
        modal.style.display = 'flex';
        modal.style.justifyContent = 'center';
        modal.style.alignItems = 'center';
        modal.style.cursor = 'pointer';

        //Création et style de l'image dans le modal
        const modalImage = document.createElement('img');
        modalImage.src = image.src;
        modalImage.style.maxWidth = '90%';
        modalImage.style.maxHeight = '90%';
        modal.appendChild(modalImage);

        //Fermeture du modal
        modal.addEventListener('click', () => {
            modal.parentNode.removeChild(modal);
        });

        //Ajout du modal au corps du document
        document.body.appendChild(modal);
    });
});
*/
