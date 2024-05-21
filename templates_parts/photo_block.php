        <?php
            $terms = wp_get_post_terms($post->ID, 'categorie', array("fields" => "ids"));
            if ($terms) {
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 2,
                    'post__not_in' => array($post->ID),
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
                                <?php the_post_thumbnail('full', array('class' => 'related-photo')); ?>
                            </a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                }
            }
        ?>