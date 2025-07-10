<footer class="bg-light text-dark mt-5 pt-5 pb-2">
	<div class="container">
		<div class="row">
			<div class="col-md-4"><?php dynamic_sidebar('footer1'); ?></div>
			<div class="col-md-4"><?php dynamic_sidebar('footer2'); ?></div>
			<div class="col-md-4"><?php dynamic_sidebar('footer3'); ?></div>
		</div>
		<div class="text-center pt-3">&copy; <?php echo date("Y");?><?php bloginfo('name');?></div>
	</div>

	<?php wp_footer(); ?>
</footer>

<!--Wrapper DIV -->
</div>
</body>
</html>