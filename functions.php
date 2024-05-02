<?php
// ******** CONFIG GENERAUX

// Enqueue
function my_theme_enqueue_assets() {
    // Enqueue le fichier style.css de votre thème
    wp_enqueue_style('style', get_stylesheet_uri());

    // Enqueue le fichier modal-style.css
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal-style.css');

    // Enqueue le fichier scripts.js de votre thème
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);

    // Enqueue le fichier modale-contact.js
    wp_enqueue_script('modale-scripts', get_template_directory_uri() . '/js/modale-contact.js', array('jquery'), null, true);

    // Enqueue le fichier contact-button.js spécifiquement pour les pages de portfolio
    if (is_singular('portfolio')) {
        wp_enqueue_script('contact-button-script', get_template_directory_uri() . '/js/contact-button.js', array('jquery'), null, true);

if (is_singular('portfolio')) {
    global $post;
    $portfolio_reference = get_field('reference', $post->ID);
    wp_localize_script('contact-button-script', 'portfolioData', array('reference' => esc_js($portfolio_reference)));
}


        // Enqueue le fichier single-portfolio.css si c'est une page de portfolio
        wp_enqueue_style('single-portfolio-style', get_template_directory_uri() . '/css/single-portfolio.css');
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');


// Inclure le fichier menu.php
require_once get_template_directory() . '/menu.php';

// Enregistrement de l'emplacement du menu principal
function register_my_menu() {
    register_nav_menu('main-menu', __('Main Menu', 'text-domain'));
}
add_action('after_setup_theme', 'register_my_menu');

// Enregistrement de l'emplacement du footer
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');

// Ajout de la prise en charge du logo personnalisé
function theme_support_setup() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_support_setup');

// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );



