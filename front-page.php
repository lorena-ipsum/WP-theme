<?php
get_header();  // Appelle votre fichier header.php

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
            <div><p>FRONT Page.php BLALABLA</p></div> 
            </header>
            <div class="entry-content">
                <?php the_content(); ?>
                <div><h2>Conteudo aqui</h2></div>
            </div>
            
        </article>
        <?php
    endwhile;
endif;

get_footer();  // Appelle votre fichier footer.php
?>
