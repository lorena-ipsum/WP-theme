<?php
// Enqueue des styles et scripts
function my_theme_enqueue_assets() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal-style.css');
    wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/css/lightbox.css');
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    wp_enqueue_script('modale-scripts', get_template_directory_uri() . '/js/modale-contact.js', array('jquery'), null, true);

    if (is_front_page()) {
        wp_enqueue_script('front-page', get_template_directory_uri() . '/js/front-page.js', array('jquery'), null, true);
        wp_enqueue_style('front-page-style', get_template_directory_uri() . '/css/front-page.css');

        global $wp_query;
        wp_localize_script('front-page', 'ajaxpagination', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'query_vars' => json_encode($wp_query->query_vars),
            'nonce' => wp_create_nonce('load_more_nonce')
        ));

        wp_localize_script('front-page', 'wpApiSettings', array(
            'root' => esc_url_raw(rest_url()),
            'nonce' => wp_create_nonce('wp_rest')
        ));
    }

    if (is_singular('portfolio')) {
        wp_enqueue_script('contact-button-script', get_template_directory_uri() . '/js/single-portfolio.js', array('jquery'), null, true);
        wp_enqueue_script('hover-thumbnails', get_template_directory_uri() . '/js/hover-thumbnails.js', array('jquery'), null, true);
        global $post;
        $portfolio_reference = get_field('reference', $post->ID);
        wp_localize_script('contact-button-script', 'portfolioData', array('reference' => esc_js($portfolio_reference)));
        wp_enqueue_style('single-portfolio-style', get_template_directory_uri() . '/css/single-portfolio.css');
    }

    // Enqueue Lightbox Script globally
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');

// Enregistrement des menus
require_once get_template_directory() . '/menu.php';

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

// Images héroïques aléatoires
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
    check_ajax_referer('load_more_nonce', '_ajax_nonce');

    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => 8,
        'paged'          => isset($_POST['paged']) ? $_POST['paged'] : 1,
        'post_status'    => 'publish'
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ob_start();
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
        $data = ob_get_clean();
        wp_send_json_success($data);
    } else {
        wp_send_json_error('Aucun autre post à charger.');
    }
    wp_die();
}
add_action('wp_ajax_nopriv_load_more', 'load_more_posts');
add_action('wp_ajax_load_more', 'load_more_posts');

// Traitement AJAX pour appliquer les filtres
function apply_filters_posts() {
    check_ajax_referer('load_more_nonce', '_ajax_nonce');

    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';

    error_log('Category: ' . $category);
    error_log('Format: ' . $format);
    error_log('Order: ' . $order);

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => $order,
        'post_status' => 'publish'
    );

    $tax_query = array('relation' => 'AND');

    if ($category) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $category,
        );
    }

    if ($format) {
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'term_id',
            'terms' => $format,
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    error_log(print_r($args, true));

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        ob_start();
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
        $data = ob_get_clean();
        wp_send_json_success($data);
    } else {
        wp_send_json_error('Aucun post trouvé pour les filtres sélectionnés.');
    }
    wp_die();
}
add_action('wp_ajax_nopriv_apply_filters', 'apply_filters_posts');
add_action('wp_ajax_apply_filters', 'apply_filters_posts');

// Lightbox
function get_adjacent_post_url($post, $previous = true) {
    $adjacent_post = get_adjacent_post(false, '', $previous);
    return $adjacent_post ? get_permalink($adjacent_post->ID) : '';
}

function enqueue_lightbox_scripts() {
    if (is_singular('portfolio')) {
        global $post;

        // Récupérer tous les IDs des posts de type portfolio
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
            'fields' => 'ids'
        );
        $portfolio_posts = get_posts($args);
        $current_post_id = $post->ID;

        // Localize script avec les IDs des posts et l'URL des posts précédent et suivant
        wp_localize_script('lightbox-script', 'lightboxData', array(
            'posts' => $portfolio_posts,
            'currentPostId' => $current_post_id
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');
