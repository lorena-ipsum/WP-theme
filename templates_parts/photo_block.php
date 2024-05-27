<?php
if (isset($related_query) && $related_query->have_posts()) {
    while ($related_query->have_posts()) {
        $related_query->the_post();
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $category_list = $categories ? join(', ', wp_list_pluck($categories, 'name')) : '';
        ?>
        <div class="portfolio-item">
            <div class="portfolio-hover">
                <a href="<?php the_permalink(); ?>" class="view-icon">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <i class="fa-solid fa-expand expand-icon"></i>
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
        ?>
        <div class="portfolio-item">
            <div class="portfolio-hover">
                <a href="<?php the_permalink(); ?>" class="view-icon">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <i class="fa-solid fa-expand expand-icon"></i>
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
