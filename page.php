<?php
get_header();  // Appelle votre fichier header.php

// Vérifie s'il y a des posts à afficher
if ( have_posts() ) :
    // Boucle à travers les posts
    while ( have_posts() ) : the_post();
        ?>
        <!-- Début de l'article avec un ID unique basé sur l'ID du post -->
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <!-- L'en-tête de l'article peut être complété si nécessaire -->
            </header>
            <div class="entry-content">
                <!-- Affiche le contenu complet du post -->
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
endif;

get_footer();  // Appelle votre fichier footer.php
?>
