<?php
get_header();  // Inclut le fichier header.php

// Section Hero avec image de fond aléatoire
function get_random_hero_image() {
    $args = array(
        'post_type' => 'portfolio',  // Utilisation de votre Custom Post Type
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'post_status' => 'publish'  // Assurez-vous de récupérer uniquement les posts publiés
    );

    $query = new WP_Query($args);
    if($query->have_posts()) {
        $query->the_post();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');  // Récupère l'URL de l'image à la une en pleine taille
        wp_reset_postdata();  // Très important pour réinitialiser les données du post
        return $image_url ? $image_url : get_template_directory_uri() . '/images/default.jpg';  // Fournit une image par défaut si aucune image à la une n'est trouvée
    } else {
        // Retournez une image par défaut si aucune image n'est trouvée
        return get_template_directory_uri() . '/images/default.jpg';
    }
}
?>
<section class="hero-section" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <h1 class="hero-text">Photographe Event</h1>
</section>

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

get_footer();  // Appelle votre fichier footer.php
?>
