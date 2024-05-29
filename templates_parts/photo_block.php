<?php
if (isset($related_query) && $related_query->have_posts()) {
    while ($related_query->have_posts()) {
        $related_query->the_post();
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $category_list = $categories ? join(', ', wp_list_pluck($categories, 'name')) : '';
        $reference = get_field('reference'); 
        ?>
        <div class="portfolio-item" data-id="<?php the_ID(); ?>" data-reference="<?php echo esc_attr($reference); ?>" data-category="<?php echo esc_attr($category_list); ?>">
            <div class="portfolio-hover">
                <a href="<?php the_permalink(); ?>" class="view-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="View Icon">
                </a>
                <a href="#" class="expand-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Fullscreen Icon">
                </a>
                <div class="image-title"><?php the_title(); ?></div>
                <div class="portfolio-category"><?php echo esc_html($category_list); ?></div>
            </div>
            <a href="<?php the_permalink(); ?>" data-lightbox="gallery" data-title="<?php the_title(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    wp_reset_postdata();
} else if (have_posts()) {
    while (have_posts()) {
        the_post();
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $category_list = $categories ? join(', ', wp_list_pluck($categories, 'name')) : '';
        $reference = get_field('reference'); 
        ?>
        <div class="portfolio-item" data-id="<?php the_ID(); ?>" data-reference="<?php echo esc_attr($reference); ?>" data-category="<?php echo esc_attr($category_list); ?>">
            <div class="portfolio-hover">
                <a href="<?php the_permalink(); ?>" class="view-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_eye.png" alt="View Icon">
                </a>
                <a href="#" class="expand-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon_fullscreen.png" alt="Fullscreen Icon">
                </a>
                <div class="image-title"><?php the_title(); ?></div>
                <div class="portfolio-category"><?php echo esc_html($category_list); ?></div>
            </div>
            <a href="<?php the_permalink(); ?>" data-lightbox="gallery" data-title="<?php the_title(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    wp_reset_postdata();
}
?>