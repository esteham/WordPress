<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name');?></title>
	<?php wp_head(); ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php

					if(has_nav_menu('top')):?>
						<nav class="nav-top">
							<?php
								wp_nav_menu(array('theme_location'=>'top'

								) );
							?>
						</nav>
					<?php endif; ?>
				<header>
					<h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
					<h4><?php bloginfo('description'); ?></h4>
				</header>
				<hr>
				<?php
					if(has_nav_menu('primary')):?>
						<nav class="nav-header">
							<?php
								wp_nav_menu( array('theme_location'=>'primary'

								));				
							?>
						</nav>
				<?php endif; ?>
				<br>
			</div>

			<img src="<?php header_image();?>" height="10%" width="100%" class="img-responsive">
		</div>
