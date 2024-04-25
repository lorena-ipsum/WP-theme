<?php
get_header();  // Appelle votre fichier header.php

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                
            </header>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
endif;

get_footer();  // Appelle votre fichier footer.php
?>
