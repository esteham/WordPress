<?php
	get_header();
?>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-7">
			<?php
				if(have_posts()): while(have_posts()): the_post();
			?>

			<h2 class="mypagetitle">
				<?php the_title(); ?>
			</h2>

			<p style="width: 60%;">
				<?php the_content(); ?>
			</p>
		<?php endwhile; endif; ?>		
		</div>

		<div class="col-md-4 col-md-offset-1 mt-5">
			<div class="sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php
	get_footer();
?>