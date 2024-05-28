<?php get_header(); ?>
<section class="hero-section" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <h1 class="hero-text">Photographe Event</h1>
</section>
<section class="main-contenu">
    <div class="filter-section">
        <div class="filter-left">
            <div class="custom-select">
                <select id="category-filter">
                    <option value="">Toutes les catégories</option>
                    <!-- Les options seront chargées dynamiquement via JavaScript -->
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="custom-select">
                <select id="format-filter">
                    <option value="">Tous les formats</option>
                    <!-- Les options seront chargées dynamiquement via JavaScript -->
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="filter-right">
            <div class="custom-select">
                <select id="sort-filter">
                    <option value="">Trier par</option>
                    <option value="DESC">À partir des plus récents</option>
                    <option value="ASC">À partir des plus anciens</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </div>
    
    <div class="portfolio-list">
        <?php
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $portfolio_query = new WP_Query($args);
        if ($portfolio_query->have_posts()) :
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                $categories = get_the_terms(get_the_ID(), 'categorie');
                $category_list = $categories ? join(', ', wp_list_pluck($categories, 'name')) : '';
                $reference = get_field('reference'); // Get the reference from ACF
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
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    
    <div id="load-more">
        <button>Charger plus</button>
    </div>
</section>
<?php
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
endif;
get_footer();
?>
