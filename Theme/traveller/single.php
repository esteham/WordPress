<?php get_header() ?>
<?php get_template_part('nav') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php 
 if ( have_posts() ) :
 while ( have_posts() ) : the_post(); 
 //loop content (template tags, html, etc)
?>
<br><br><br>
<h3><?php the_title()?></h3>
<br>
<div><img src="<?php the_post_thumbnail_url()?>" alt=""></div>
<br>
<p><?php the_content()?></p>
<?php
endwhile;
 endif;
?>
</div>
</div>
</div>
<?php get_footer() ?>