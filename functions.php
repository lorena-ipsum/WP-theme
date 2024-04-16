<?php
// Enqueue des scripts et styles
function my_theme_enqueue_styles() {
    // Enqueue le fichier style.css de votre thème
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Enregistrement de l'emplacement du menu
function register_my_menu() {
    register_nav_menu('main-menu', __('Main Menu'));
}
add_action('after_setup_theme', 'register_my_menu');

// Enregistrement de l'emplacement du footer
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');
