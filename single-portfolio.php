<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <div class="portfolio-container">
            <div class="portfolio-info">
                <div class="info-left">
                    <h1 class="portfolio-title"><?php the_title(); ?></h1>
                    <p>Référence: <?php echo esc_html( get_field('reference') ); ?></p>
                    <p>Catégorie: <?php 
                                    $terms = get_the_terms( $post->ID, 'categorie' );
                                    if ( $terms && ! is_wp_error($terms) ) {
                                        $term_names = wp_list_pluck($terms, 'name');
                                        echo esc_html( implode(', ', $term_names) );
                                    }
                                ?></p>
                    <p>Format: <?php 
                                    $format_terms = get_the_terms( $post->ID, 'formats' ); 
                                    if ( !empty($format_terms) && !is_wp_error($format_terms) ) {
                                        $format_names = wp_list_pluck($format_terms, 'name');
                                        echo esc_html(implode(', ', $format_names));
                                    }
                                ?></p>
                    <p>Type: <?php echo esc_html( get_field('type') ); ?></p>
                    <p>Date de prise de vue: <?php echo get_the_date('Y'); ?></p>
                    <!-- Ici, ajoutez votre lien de contact et la logique pour préremplir le champ de la référence de la photo -->
                </div>
                <div class="info-right">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php endif; ?>
                </div>
            <div class="interaction-block">
                <div class="interest-text">
                    <p>Cette photo vous intéresse ?</p>
                </div>
                <div class="contact-button-container">
                    <button class="contact-button" id="open-contact-modal">Contact</button>
                </div>
                <div class="next-photo-container">
                    <?php
                    $next_post = get_next_post();
                    if (!empty($next_post)): ?>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                            <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', array('style' => 'width: 81px; height: 71px;')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="next-fleches">
                        <?php
                        $previous_post = get_previous_post();
                        $next_post = get_next_post();
                        if (!empty($previous_post)): ?>
                            <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" class="fleche-gauche">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/leftarrow.svg" alt="Précédent" />
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($next_post)): ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="fleche-droite">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/rightarrow.svg" alt="Suivant" />
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
            <div class="related-photos">
                <h2>Vous aimerez aussi</h2>
                <div class="photos-container">
                <?php
                    $terms = wp_get_post_terms($post->ID, 'categorie', array("fields" => "ids"));
                    if ($terms) {
                        $args = array(
                            'post_type' => 'portfolio', // Assurez-vous que c'est le bon type de post
                            'posts_per_page' => 2, // Limitez à 2 entrées
                            'post__not_in' => array($post->ID), // Excluez le post actuel
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'categorie',
                                    'field' => 'term_id',
                                    'terms' => $terms
                                )
                            )
                        );
                        $related_query = new WP_Query($args);

                        if ($related_query->have_posts()) {
                            while ($related_query->have_posts()) {
                                $related_query->the_post();
                                ?>
                                <div class="related-photo">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('full', array('style' => 'width: 564px; height: 495px; object-fit: cover;')); ?>
                                    </a>
                                </div>
                            <?php
                            }
                            wp_reset_postdata();
                        }
                    }
                ?>
                </div>
            </div>
        <?php
    endwhile;
endif;

get_footer();
?>
