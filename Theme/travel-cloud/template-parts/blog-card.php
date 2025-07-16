<?php
/**
 * Blog card template part
 *
 * @package TravelCloud
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="blog-card-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="blog-card-content">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            
            <div class="entry-meta">
                <?php
                travelcloud_posted_on();
                travelcloud_posted_by();
                ?>
            </div>
        </header>

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>

        <footer class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'travelcloud'); ?></a>
        </footer>
    </div>
</article>