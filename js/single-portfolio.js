console.log ("This is the  contact button portfolio trucbidule")

jQuery(document).ready(function($) {
    $('#open-contact-modal').on('click', function() {
        console.log('Reference:', portfolioData.reference); // Vérifiez si cela affiche la référence correcte dans la console
        
        $('#contact-modal').fadeIn();
        
        // Pré-remplir le champ de référence de la photo
        $('#reference-field').val(portfolioData.reference); // Assurez-vous que le sélecteur est correct
    });

    $('#close-modal-button').on('click', function() {
        $('#contact-modal').fadeOut();
    });
});

jQuery(document).ready(function($) {
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
