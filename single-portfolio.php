<?php 
get_header(); // Appelle votre fichier header.php

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <!-- Conteneur principal du portfolio -->
        <div class="portfolio-container">
            <div class="portfolio-info">
                <div class="info-left">
                    <!-- Titre du portfolio -->
                    <h1 class="portfolio-title"><?php the_title(); ?></h1>
                    <!-- Affiche la référence du portfolio -->
                    <p>Référence : <?php echo esc_html(get_field('reference')); ?></p>
                    <!-- Affiche les catégories du portfolio -->
                    <p>Catégorie : <?php
                        $terms = get_the_terms(get_the_ID(), 'categorie');
                        if ($terms && !is_wp_error($terms)) {
                            $term_names = wp_list_pluck($terms, 'name');
                            echo esc_html(implode(', ', $term_names));
                        }
                    ?></p>
                    <!-- Affiche les formats du portfolio -->
                    <p>Format : <?php
                        $format_terms = get_the_terms(get_the_ID(), 'formats');
                        if ($format_terms && !is_wp_error($format_terms)) {
                            $format_names = wp_list_pluck($format_terms, 'name');
                            echo esc_html(implode(', ', $format_names));
                        }
                    ?></p>
                    <!-- Affiche le type du portfolio -->
                    <p>Type : <?php echo esc_html(get_field('type')); ?></p>
                    <!-- Affiche l'année du portfolio -->
                    <p>Année : <?php echo get_the_date('Y'); ?></p>
                </div>
                <div class="info-right">
                    <!-- Affiche la miniature du post s'il y en a une -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div id="main-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="interaction-block">
                <div class="interest-container">
                    <div class="interest-text">
                        <p>Cette photo vous intéresse ?</p>
                    </div>
                    <div class="contact-button-container">
                        <!-- Bouton pour ouvrir la modale de contact -->
                        <button class="contact-button" id="open-contact-modal">Contact</button>
                    </div>
                </div>
                <div class="next-photo-container">
                    <!-- Affiche la miniature du post suivant s'il y en a un -->
                    <?php
                    $next_post = get_next_post();
                    if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" id="next-post-thumbnail">
                            <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', array('style' => 'width: 81px; height: 71px;')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="next-fleches">
                        <!-- Flèche pour le post précédent -->
                        <?php
                        $previous_post = get_previous_post();
                        if ($previous_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" class="fleche-gauche" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($previous_post->ID, 'full')); ?>">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/leftarrow.jpg'); ?>" class="leftarrow" alt="Précédent" />
                            </a>
                        <?php endif; ?>
                        <!-- Flèche pour le post suivant -->
                        <?php if ($next_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="fleche-droite" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($next_post->ID, 'full')); ?>">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/rightarrow.jpg'); ?>" class="rightarrow" alt="Suivant" />
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="thumbnail-preview"></div>
                </div>
            </div>
            <div class="related-photos">
                <h2>Vous aimerez aussi</h2>
                <div class="photos-container">
                    <!-- Affiche des photos similaires basées sur les catégories -->
                    <?php
                    $terms = wp_get_post_terms(get_the_ID(), 'categorie', array("fields" => "ids"));
                    if ($terms) {
                        $args = array(
                            'post_type' => 'portfolio',
                            'posts_per_page' => 2,
                            'post__not_in' => array(get_the_ID()),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categorie',
                                    'field' => 'term_id',
                                    'terms' => $terms
                                )
                            )
                        );
                        $related_query = new WP_Query($args);
                        set_query_var('related_query', $related_query);
                        get_template_part('templates_parts/photo_block');
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endwhile;
endif;

get_footer(); // Appelle votre fichier footer.php
?>
