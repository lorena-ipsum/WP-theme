<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='robots' content='max-image-preview:large' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
        <div class="header-container">
            <div class="site-logo">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="custom-logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                <?php endif; ?>
            </div><!-- .site-logo -->

            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Menu principal', 'text-domain' ); ?>">
                <button type="button" aria-expanded="false" aria-controls="primary-menu" class="menu-toggle">
                     <span class="icon"><i class="fal fa-bars"></i></span>
                </button>

                <?php
                // Afficher le menu principal
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'main-menu',
                    'container'      => false,
                    'walker'         => new Mota_Walker_Nav_Menu()
                ) );
                ?>
            </nav><!-- #site-navigation -->
        </div><!-- .header-container -->
        
    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <!-- Votre contenu va ici -->
    </div>

    <?php wp_footer(); ?>
</body>
</html>
