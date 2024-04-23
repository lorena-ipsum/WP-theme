console:console.log(you got it girl);

//EFFET D'APPARITION DES PAGE EN FONDUE
document.addEventListener('DOMContentLoaded', function() {
    const body = document.querySelector('body');

    // Masquer le contenu de la page par défaut
    body.style.opacity = 0;

    // Fonction pour effectuer le fondu en entrant
    function fadeIn() {
        let opacity = 0;
        const interval = setInterval(function() {
            if (opacity < 1) {
                opacity += 0.1;
                body.style.opacity = opacity;
            } else {
                clearInterval(interval);
            }
        }, 300); // Répétez toutes les 50 millisecondes pour un effet fluide
    }

    // Fonction pour effectuer le fondu en sortant
    function fadeOut() {
        let opacity = 1;
        const interval = setInterval(function() {
            if (opacity > 0) {
                opacity -= 0.1;
                body.style.opacity = opacity;
            } else {
                clearInterval(interval);
            }
        }, 300); // Répétez toutes les 50 millisecondes pour un effet fluide
    }

    // Appeler la fonction fadeIn lorsque le contenu de la page est chargé
    window.addEventListener('load', function() {
        fadeIn();
    });
});




/*
//MODALE DE CONTACT
document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.getElementById('menu-item-53');
    const contactModal = document.getElementById('contact-modal');
    const closeModalButton = document.getElementById('close-modal-button');

    function openModal() {
        if (contactModal) {
            contactModal.classList.add('show-modal');
        }
    }

    function closeModal() {
        if (contactModal) {
            contactModal.classList.remove('show-modal');
        }
    }

    if (contactLink) {
        contactLink.addEventListener('click', function(event) {
            event.preventDefault();
            openModal();
        });
    }

    if (closeModalButton) {
        closeModalButton.addEventListener('click', function() {
            closeModal();
        });
    }

    window.addEventListener('click', function(event) {
        if (contactModal && event.target === contactModal) {
            closeModal();
        }
    });
});
*/
