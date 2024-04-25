<?php
get_header();  // Appelle votre fichier header.php

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="entry-content">
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">Read More</a>
            </div>
        </article>
        <?php
    endwhile;
else :
    ?><p><?php _e('Sorry, no posts matched your criteria.', 'text-domain'); ?></p><?php
endif;

get_footer();  // Appelle votre fichier footer.php
?>
