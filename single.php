<?php
get_header();  // Appelle votre fichier header.php

// Vérifie s'il y a des posts à afficher
if ( have_posts() ) :
    // Boucle à travers les posts
    while ( have_posts() ) : the_post();
        ?>
        <!-- Début de l'article avec un ID unique basé sur l'ID du post -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <!-- Titre de l'article -->
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
                <!-- Affiche le contenu complet du post -->
                <?php the_content(); ?>
            </div>
        </article>
        <?php
        // Affiche les commentaires si ouverts ou s'il y a des commentaires existants
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    endwhile;
endif;

get_footer();  // Appelle votre fichier footer.php
?>
