<?php get_header(); ?>

<main id="site-content" role="main">

    <?php
    // Début de la boucle WordPress.
    while ( have_posts() ) :
        the_post();

        // Inclure le modèle de contenu de la publication.
        get_template_part( 'template-parts/content/content-single' );

        // Si les commentaires sont autorisés ou s'il y a au moins un commentaire, inclure le modèle de commentaires.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // Fin de la boucle WordPress.
    ?>

</main><!-- #site-content -->

<?php get_footer(); ?>
