<?php
// Vérifie si $related_query est défini et contient des posts
if (isset($related_query) && $related_query->have_posts()) {
    // Boucle à travers les posts de $related_query
    while ($related_query->have_posts()) {
        $related_query->the_post();
        
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
            <!-- Lien pour la lightbox -->
            <a href="<?php the_permalink(); ?>" data-lightbox="gallery" data-title="<?php the_title(); ?>">
                <!-- Miniature de l'image du post -->
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    // Réinitialise les données postales
    wp_reset_postdata();
} else if (have_posts()) {
    // Boucle à travers les posts principaux
    while (have_posts()) {
        the_post();
        
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
            <!-- Lien pour la lightbox -->
            <a href="<?php the_permalink(); ?>" data-lightbox="gallery" data-title="<?php the_title(); ?>">
                <!-- Miniature de l'image du post -->
                <?php the_post_thumbnail('full', array('class' => 'portfolio-image')); ?>
            </a>
        </div>
        <?php
    }
    // Réinitialise les données postales
    wp_reset_postdata();
}
?>
