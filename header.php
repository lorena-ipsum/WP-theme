<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='robots' content='max-image-preview:large' />
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

            <nav id="site-navigation" class="main-navigation" role="navigation">
                <?php
                // Afficher le menu principal
                wp_nav_menu( array(
                    'theme_location' => 'main-menu', // Emplacement du menu à afficher
                    'menu_id'        => 'primary-menu', // ID attribué au menu
                ) );
                ?>
            </nav><!-- #site-navigation -->
        </div><!-- .header-container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <!-- Votre contenu va ici -->
    </div><!-- #content -->
