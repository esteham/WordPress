<?php
/**
 * The template for displaying archive pages
 *
 * @package TravelCloud
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="main" class="content-area">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                </header>

                <div class="posts-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/blog-card');
                    endwhile;
                    ?>
                </div>

                <?php the_posts_navigation(); ?>

            <?php else : ?>
                <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </main>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();