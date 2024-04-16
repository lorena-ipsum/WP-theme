<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="masthead" class="site-header" role="banner">
        <div class="header-container">
            <div class="site-logo">
                <?php
                // Vérifier si le logo personnalisé est défini
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    // Si aucun logo personnalisé n'est défini, afficher le nom du site
                    echo '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>';
                }
                ?>
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
