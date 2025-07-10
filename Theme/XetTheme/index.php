<?php get_header(); ?>
<div class="row">
	<div class="col-md-8">
		<?php

			if(have_posts()):
				while(have_posts()): the_post();?>

		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<p><?php the_excerpt(); ?></p>
	<?php endwhile; else:

		echo "<p>No content found</p>";
	endif;
	  ?>
	</div>

	<div class="col-md-4 mt-5">
		<div class="sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>