<?php
// ***** Enqueue des styles et scripts
function my_theme_enqueue_assets() {
    // Styles globaux
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal-style.css');

    // Scripts globaux
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    wp_enqueue_script('modale-scripts', get_template_directory_uri() . '/js/modale-contact.js', array('jquery'), null, true);

    // Scripts et styles pour la page d'accueil
    if (is_front_page()) {
        wp_enqueue_script('front-page', get_template_directory_uri() . '/js/front-page.js', array('jquery'), null, true);
        wp_enqueue_style('front-page-style', get_template_directory_uri() . '/css/front-page.css');

        // Préparation des données pour le script
        global $wp_query; // Assurez-vous d'avoir accès à la variable globale
        wp_localize_script('front-page', 'ajaxpagination', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'query_vars' => json_encode($wp_query->query_vars)
        ));

        // Localiser wpApiSettings pour accéder à l'API REST
        wp_localize_script('front-page', 'wpApiSettings', array(
            'root' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ));
    }

    // Scripts et styles pour les pages de type 'portfolio'
    // Enqueue script for single portfolio
    if (is_singular('portfolio')) {
        wp_enqueue_script('contact-button-script', get_template_directory_uri() . '/js/single-portfolio.js', array('jquery'), null, true);
        wp_enqueue_script('hover-thumbnails', get_template_directory_uri() . '/js/hover-thumbnails.js', array('jquery'), null, true);
        global $post;
        $portfolio_reference = get_field('reference', $post->ID);
        wp_localize_script('contact-button-script', 'portfolioData', array('reference' => esc_js($portfolio_reference)));
        wp_enqueue_style('single-portfolio-style', get_template_directory_uri() . '/css/single-portfolio.css');
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');


// ***** MENU
// Inclure le fichier menu.php
require_once get_template_directory() . '/menu.php';

// Enregistrement des menus
function register_my_menu() {
    register_nav_menu('main-menu', __('Main Menu', 'text-domain'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_my_menu');

// Support pour le logo personnalisé et les images mises en avant
function theme_support_setup() {
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'theme_support_setup');

// ***** FRONT-PAGE
//Random hero images
function get_random_hero_image() {
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        $query->the_post();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        wp_reset_postdata();
        return $image_url ? $image_url : get_template_directory_uri() . '/images/default.jpg';
    } else {
        return get_template_directory_uri() . '/images/default.jpg';
    }
}

// Traitement AJAX pour charger plus de posts
function load_more_posts() {
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => 8,
        'paged'          => isset($_POST['paged']) ? $_POST['paged'] : 1,
        'post_status'    => 'publish'
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="portfolio-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<div class="no-more-posts">Aucun autre post à charger.</div>';
    }
    wp_die();
}
add_action('wp_ajax_nopriv_load_more', 'load_more_posts');
add_action('wp_ajax_load_more', 'load_more_posts');
