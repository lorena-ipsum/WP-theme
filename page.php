<?php
/**
 * Template Name: Página Personalizada
 *
 * Este é o modelo para exibir páginas personalizadas do WordPress.
 * Você pode adicionar seu próprio conteúdo HTML e PHP aqui.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Loop padrão do WordPress para exibir o conteúdo da página
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page'); // Exibe o conteúdo da página
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
