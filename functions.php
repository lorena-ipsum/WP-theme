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

function theme_support_setup() {
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'theme_support_setup' );

//code pour ajouter la section Logo dans le dashboard
function theme_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'theme_logo_section' , array(
        'title'       => __( 'Logo', 'your_theme' ),
        'priority'    => 30,
        'description' => 'Upload a logo to display in the header',
    ) );

    $wp_customize->add_setting( 'theme_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
        'label'    => __( 'Logo', 'your_theme' ),
        'section'  => 'theme_logo_section',
        'settings' => 'theme_logo',
    ) ) );
}
add_action( 'customize_register', 'theme_customize_register' );
