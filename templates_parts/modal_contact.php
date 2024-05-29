<!-- Définition de la modale de contact, cachée par défaut -->
<div id="contact-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <!-- En-tête de la modale contenant une image et un bouton de fermeture -->
        <div class="modal-header">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/modal-header.jpg" alt="Header de la modale">
            <span id="close-modal-button" class="close">&times;</span>
        </div>
        <!-- Corps de la modale contenant le formulaire de contact -->
        <div class="modal-body">
            <?php echo do_shortcode('[contact-form-7 id="61fa7c2" title="Modale de Contact"]'); ?>
        </div>
    </div>
</div>
