<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-container">
        <?php
        // Affiche le menu du footer s'il est défini
        if (has_nav_menu('footer-menu')) {
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_id'        => 'footer-menu',
                'container'      => 'nav',
                'container_class' => 'footer-menu-container',
            ));
        }
        ?>
    </div><!-- .footer-container -->
    <?php get_template_part('templates_parts/modal_contact'); ?>
    
    <!-- Lightbox HTML -->
    <div class="lightbox-modal" style="display:none;">
        <span class="close-lightbox">&times;</span>
        <img src="" alt="" class="lightbox-content">
    </div>
</footer><!-- #colophon -->
