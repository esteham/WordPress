<?php
/*
The Template for displaying all single posts
*/
?>

<?php get_header(); ?>

<!-- Blog Area-->

<div class="row">
	<div class="col-sm-7">
		<?php
			if(have_posts()): while(have_posts()): the_post();
		?>

		<h1>
			<a href="<?php the_permalink(); ?>" class="gray"><?php the_title(); ?></a>
		</h1>

		<p class="details">
			By<a href="<?php the_author_posts(); ?>"><?php the_author(); ?></a> On <?php echo get_the_date("F j,Y");?>/In<?php the_category(','); ?>
		</p>

		<?php
			if(has_post_thumbnail()):
		?>

		<p class="excerpt">
			<?php the_post_thumbnail(); ?>
		</p>
	<?php endif; ?>
		<p>
			<?php the_content(); ?>
		</p>
	<?php endwhile; ?>
<?php endif; ?>

<div class="comment-section">
	<?php

		if(comments_open() || '0' !=get_comments_number()):
			comments_template();
	endif;
	?>
</div>
</div>

<!-- Sidebar Area -->
<div class="col-sm-5 col-md-offset-1 mt-5">
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
</div>
<?php get_footer(); ?>