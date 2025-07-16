<?php
/**
 * The main template file
 *
 * @package TravelCloud
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="main" class="content-area">
            <?php if (have_posts()) : ?>
                <div class="posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/blog-card'); ?>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_navigation(); ?>
            <?php else : ?>
                <article class="no-results">
                    <header class="entry-header">
                        <h1 class="entry-title"><?php esc_html_e('Nothing Found', 'travelcloud'); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php if (is_search()) : ?>
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'travelcloud'); ?></p>
                            <?php get_search_form(); ?>
                        <?php else : ?>
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'travelcloud'); ?></p>
                            <?php get_search_form(); ?>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endif; ?>
        </main>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();