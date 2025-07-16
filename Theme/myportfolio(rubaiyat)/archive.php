<?php get_header(); ?>

<div class="container my-5">
    <h1 class="mb-4"><?php the_archive_title(); ?></h1>

    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="mb-4 pb-3 border-bottom">
                    <h2><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h2>
                    <?php if(has_post_thumbnail()): ?>
                        <div class="mb-2">
                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                        </div>
                    <?php endif; ?>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Read More</a>
                </div>
            <?php endwhile; else: ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
