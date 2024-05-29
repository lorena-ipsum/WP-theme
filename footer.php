<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-container">
        <?php
        // Vérifie si un menu de pied de page est défini
        if (has_nav_menu('footer-menu')) {
            // Affiche le menu de pied de page
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',        // Emplacement du menu
                'menu_id'        => 'footer-menu',        // ID du menu
                'container'      => 'nav',                // Balise conteneur
                'container_class' => 'footer-menu-container', // Classe du conteneur
            ));
        }
        ?>
    </div>
    
    <!-- Inclusion de la modale de contact -->
    <?php get_template_part('templates_parts/modal_contact'); ?>
    
    <!-- Lightbox HTML -->
    <div class="lightbox-modal">
        <span class="close-lightbox">&times;</span> <!-- Bouton de fermeture de la lightbox -->
        <div class="lightbox-content-wrapper">
            <!-- Navigation pour l'image précédente dans la lightbox -->
            <div class="lightbox-nav lightbox-prev">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/precedent.png'); ?>" alt="Précédent" />
                <span>Précédent</span>
            </div>
            <!-- Contenu central de la lightbox -->
            <div class="lightbox-center">
                <img src="" alt="" class="lightbox-content"> <!-- Image affichée dans la lightbox -->
                <div class="lightbox-details">
                    <div class="reference"></div> <!-- Référence de l'image -->
                    <div class="category"></div>  <!-- Catégorie de l'image -->
                </div>
            </div>
            <!-- Navigation pour l'image suivante dans la lightbox -->
            <div class="lightbox-nav lightbox-next">
                <span>Suivant</span>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/suivant.png'); ?>" alt="Suivant" />
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
