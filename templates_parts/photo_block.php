<?php
if (isset($related_query) && $related_query->have_posts()) {
    while ($related_query->have_posts()) {
        $related_query->the_post();
        ?>
        <div class="portfolio-item">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    wp_reset_postdata();
} else if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <div class="portfolio-item">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    wp_reset_postdata();
}
?>
