<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-container">
        <?php
        if (has_nav_menu('footer-menu')) {
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_id'        => 'footer-menu',
                'container'      => 'nav',
                'container_class' => 'footer-menu-container',
            ));
        }
        ?>
    </div>
    <!-- Modale de Contact -->
    <?php get_template_part('templates_parts/modal_contact'); ?>
    <!-- Lightbox HTML -->
    <div class="lightbox-modal">
        <span class="close-lightbox">&times;</span>
        <div class="lightbox-content-wrapper">
            <div class="lightbox-nav lightbox-prev">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/precedent.png'); ?>" alt="Précédent" />
                <span>Précédent</span>
            </div>
            <div class="lightbox-center">
                <img src="" alt="" class="lightbox-content">
                <div class="lightbox-details">
                    <div class="reference"></div>
                    <div class="category"></div>
                </div>
            </div>
            <div class="lightbox-nav lightbox-next">
                <span>Suivant</span>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/suivant.png'); ?>" alt="Suivant" />
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
