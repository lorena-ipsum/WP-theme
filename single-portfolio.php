<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <div class="portfolio-container">
            <div class="portfolio-info">
                <div class="info-left">
                    <h1 class="portfolio-title"><?php the_title(); ?></h1>
                    <p>Référence : <?php echo esc_html( get_field('reference') ); ?></p>
                    <p>Catégorie : <?php 
                                    $terms = get_the_terms( $post->ID, 'categorie' );
                                    if ( $terms && ! is_wp_error($terms) ) {
                                        $term_names = wp_list_pluck($terms, 'name');
                                        echo esc_html( implode(', ', $term_names) );
                                    }
                                ?></p>
                    <p>Format : <?php 
                                    $format_terms = get_the_terms( $post->ID, 'formats' ); 
                                    if ( !empty($format_terms) && !is_wp_error($format_terms) ) {
                                        $format_names = wp_list_pluck($format_terms, 'name');
                                        echo esc_html(implode(', ', $format_names));
                                    }
                                ?></p>
                    <p>Type: <?php echo esc_html( get_field('type') ); ?></p>
                    <p>Année : <?php echo get_the_date('Y'); ?></p>
                </div>
                <div class="info-right">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php endif; ?>
                </div>
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
                            <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" class="fleche-gauche" data-thumbnail="<?php echo get_the_post_thumbnail_url($previous_post->ID, 'thumbnail'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/leftarrow.jpg" class="leftarrow" alt="Précédent" />
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($next_post)): ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="fleche-droite" data-thumbnail="<?php echo get_the_post_thumbnail_url($next_post->ID, 'thumbnail'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/rightarrow.jpg" class="rightarrow" alt="Suivant" />
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="thumbnail-preview"></div>
                </div>
            </div>
                <div class="related-photos">
                    <h2>Vous aimerez aussi</h2>
                    <div class="photos-container">
                        <?php get_template_part('templates_parts/photo_block'); ?>
                    </div>
                </div>                
                <?php
                endwhile;
            endif;
            ?> 
        </div>
        <?php get_footer() ?>
