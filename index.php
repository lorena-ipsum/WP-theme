<?php
get_header();  // Appelle votre fichier header.php

// Vérifie s'il y a des posts à afficher
if ( have_posts() ) :
    // Boucle à travers les posts
    while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <!-- Titre du post avec lien vers le post complet -->
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="entry-content">
                <!-- Affiche un extrait du contenu du post -->
                <?php the_excerpt(); ?>
                <!-- Lien pour lire le post complet -->
                <a href="<?php the_permalink(); ?>">Continuer de lire</a>
            </div>
        </article>
        <?php
    endwhile;
else :
    // Message affiché s'il n'y a aucun post correspondant aux critères
    ?><p><?php _e('Désolé, aucun post ne correspond à vos critères.', 'text-domain'); ?></p><?php
endif;

get_footer();  // Appelle votre fichier footer.php
?>
