<?php
/**
 * The template for displaying all single posts
 *
 * @package TravelCloud
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="main" class="content-area">
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', 'single');

                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'travelcloud') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'travelcloud') . '</span> <span class="nav-title">%title</span>',
                    )
                );

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();