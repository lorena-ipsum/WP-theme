<?php
get_header();  // appele le fichier header.php

?>
<section class="hero-section" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <h1 class="hero-text">Photographe Event</h1>
</section>
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
                    <option value="date_desc">A partir des plus récents</option>
                    <option value="date_asc">A partir des plus anciens</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </div>
<div class="portfolio-list">
    <?php
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 8,  // nombre de posts affichés
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $portfolio_query = new WP_Query($args);

    if ($portfolio_query->have_posts()) :
        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
            ?>
            <div class="portfolio-item">
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

<?php
// Boucle WordPress principale pour afficher le contenu de la page
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

get_footer();  // Appelle le fichier footer.php
?>
