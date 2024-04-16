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
</footer><!-- #colophon -->
