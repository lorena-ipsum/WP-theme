<?php
/**
 * O modelo para exibir posts individuais.
 *
 * Este é o modelo padrão para exibir posts individuais do WordPress.
 * Você pode adicionar seu próprio conteúdo HTML e PHP aqui.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Loop padrão do WordPress para exibir posts individuais
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'single'); // Exibe o conteúdo do post individual
            // Se você quiser adicionar comentários, descomente a linha abaixo
            // comments_template();
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
