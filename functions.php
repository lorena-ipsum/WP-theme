<?php
// ******** CONFIG GENERAUX
// Enqueue
function my_theme_enqueue_assets() {
    // Enqueue le fichier style.css de votre thème
    wp_enqueue_style('style', get_stylesheet_uri());

    // Enqueue le fichier modal-style.css
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal-style.css');

    // Enqueue le fichier scripts.js de votre thème
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');


// Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

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


