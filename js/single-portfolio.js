console.log("This code is so beautiful, by the way i'm single. Single-portfolio, babe");

jQuery(document).ready(function($) {
    // Ouvrir la modale de contact lors du clic sur le bouton correspondant
    $('#open-contact-modal').on('click', function() {
        console.log('Reference:', portfolioData.reference); // Vérifiez si cela affiche la référence correcte dans la console
        
        $('#contact-modal').fadeIn();
        
        // Pré-remplir le champ de référence de la photo
        $('#reference-field').val(portfolioData.reference); // Assurez-vous que le sélecteur est correct
    });

    // Fermer la modale de contact lors du clic sur le bouton de fermeture
    $('#close-modal-button').on('click', function() {
        $('#contact-modal').fadeOut();
    });

    // Afficher la miniature au survol des flèches gauche et droite
    $('.fleche-gauche, .fleche-droite').hover(function() {
        var thumbnailUrl = $(this).data('thumbnail');
        if (thumbnailUrl) {
            var offset = $(this).offset();
            $('.thumbnail-preview').html('<img src="' + thumbnailUrl + '">').css({
                top: offset.top + $(this).height() + 10,
                left: offset.left
            }).fadeIn();
        }
    }, function() {
        $('.thumbnail-preview').fadeOut();
    });
});
