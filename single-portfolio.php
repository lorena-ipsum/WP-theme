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
                    <p>je suis une img </p>
                        <div class=next-fleches>
                            <p>je suis un fleche gauche</p>
                            <p>je suis un fleche droite</p>
                        </div>
                </div>
                <!-- La structure pour le conteneur de droite sera ajoutée plus tard -->
            </div>
            </div>
        </div>
            <div class="related-photos">
                <!-- Ici, vous pouvez ajouter le code pour afficher les photos apparentées -->
            </div>
        </div>
        <?php
    endwhile;
endif;

get_footer();
?>
