<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <?php
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <h1><?php the_title(); ?></h1>
                        <?php if(has_post_thumbnail()): ?>
                            <div class="mb-3">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                            </div>
                        <?php endif; ?>
                        <?php the_content(); ?>
                        <hr>
                        <p>Category: <?php the_category(', '); ?> | Tags: <?php the_tags('', ', '); ?></p>
                    <?php endwhile;
                endif;
            ?>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
