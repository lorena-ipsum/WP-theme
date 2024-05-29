<?php get_header(); ?>

<!-- Section Hero avec une image de fond aléatoire -->
<section class="hero-section" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <h1 class="hero-text">Photographe Event</h1>
</section>

<section class="main-contenu">
    <!-- Section des filtres -->
    <div class="filter-section">
        <div class="filter-left">
            <!-- Filtre par catégorie -->
            <div class="custom-select">
                <select id="category-filter">
                    <option value="">Toutes les catégories</option>
                    <!-- Les options seront chargées dynamiquement via JavaScript -->
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <!-- Filtre par format -->
            <div class="custom-select">
                <select id="format-filter">
                    <option value="">Tous les formats</option>
                    <!-- Les options seront chargées dynamiquement via JavaScript -->
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="filter-right">
            <!-- Filtre par ordre de tri -->
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
    
    <!-- Liste du portfolio -->
    <div class="portfolio-list">
        <?php
        // Arguments pour la requête WP_Query
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $portfolio_query = new WP_Query($args);
        if ($portfolio_query->have_posts()) :
            // Boucle à travers les posts du portfolio
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                // Récupère les catégories du post courant
                $categories = get_the_terms(get_the_ID(), 'categorie');
                // Crée une liste des noms de catégories séparés par des virgules
                $category_list = $categories ? join(', ', wp_list_pluck($categories, 'name')) : '';
                // Récupère la valeur du champ personnalisé 'reference'
                $reference = get_field('reference'); 
                ?>
                <div class="portfolio-item" data-id="<?php the_ID(); ?>" data-reference="<?php echo esc_attr($reference); ?>" data-category="<?php echo esc_attr($category_list); ?>">
                    <div class="portfolio-hover">
                        <!-- Lien pour afficher le post -->
                        <a href="<?php the_permalink(); ?>" class="view-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icon_eye.png" alt="View Icon">
                        </a>
                        <!-- Lien pour agrandir l'image -->
                        <a href="#" class="expand-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icon_fullscreen.png" alt="Fullscreen Icon">
                        </a>
                        <!-- Titre de l'image -->
                        <div class="image-title"><?php the_title(); ?></div>
                        <!-- Liste des catégories de l'image -->
                        <div class="portfolio-category"><?php echo esc_html($category_list); ?></div>
                    </div>
                    <!-- Lien pour afficher l'image en plein écran -->
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
                    </a>
                </div>
                <?php
            endwhile;
            // Réinitialise les données postales
            wp_reset_postdata();
        endif;
        ?>
    </div>
    
    <!-- Bouton pour charger plus de posts -->
    <div id="load-more">
        <button>Charger plus</button>
    </div>
</section>

<?php
// Affiche le contenu des autres posts si disponible
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
