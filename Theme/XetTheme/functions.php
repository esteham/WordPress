<?php

function theme_resource()
{
	wp_enqueue_style('style',get_stylesheet_uri());	
}

add_action('wp_enqueue_scripts','theme_resource');

//Add Menu

register_nav_menus(array('primary'=>__('Primary Menu'),				  
					'top'=>__('Top Menu'),
					'footer' => __('Footer Menu'),));

//Header Imgae

$header_img = array(

			'default-image'=>get_template_directory_uri().'/header.jpg',
			'uploads'=>true,);
add_theme_support('custom-header',$header_img);

//Add Sidebar
register_sidebar( array(

				'name'=>__('sidebar','cartheme'),
				'id'=>'cartheme-sidebar',
				'description'=>'Dynamic Sidebar',
				'before_widget'=>'<section id="sid">',
				'after_widget'=>'</section>',
				'before_title'=>'<h2 id="widget-title">',
				'after_title' => '</h2>'

));

//Add thumbnail support
add_theme_support('post-thumbnails');
set_post_thumbnail_size(800,9999);

//Footer Widgets

register_sidebar( 

					array(

							'name'=>esc_html__('Footer1','demoTheme'),
							'id'=>'footer1',
							'description'=>esc_html__('Add widget here fo the content of footer 1'),
							'before_widget'=>'<section id="%1$s" class="widget%2$s">',
							'after_widget'=>'</section>',
							'before_title'=>'<h3>',
							'after_title'=>'</h3>'

						));

register_sidebar( 

					array(

							'name'=>esc_html__('Footer2','demoTheme'),
							'id'=>'footer2',
							'description'=>esc_html__('Add widget here fo the content of footer 2'),
							'before_widget'=>'<section id="%1$s" class="widget%2$s">',
							'after_widget'=>'</section>',
							'before_title'=>'<h3>',
							'after_title'=>'</h3>'

						));
	

register_sidebar( 

					array(

							'name'=>esc_html__('Footer3','demoTheme'),
							'id'=>'footer3',
							'description'=>esc_html__('Add widget here fo the content of footer 3'),
							'before_widget'=>'<section id="%1$s" class="widget%2$s">',
							'after_widget'=>'</section>',
							'before_title'=>'<h3>',
							'after_title'=>'</h3>'

						));
//Theme Color Support

function theme_customize_register($wp_customize)
{
	//Text Color

	$wp_customize->add_setting('text_color', array(

						'default'=>'',
						'transport'=>'refresh'
					));
	$wp_customize->add_control(new WP_Customize_Color_Control(

					$wp_customize, 'text_color',array(

						'section'=>'colors',
						'label'=>esc_html__('Text Color','demoTheme'),
					)));

	//Link Color

	$wp_customize->add_setting('link_color', array(

						'default'=>'',
						'transport'=>'refresh',
						'sanitize_callback'=>'sanitize_hex_color'
					));
	$wp_customize->add_control(new WP_Customize_Color_Control(

					$wp_customize, 'link_color',array(

						'section'=>'colors',
						'label'=>esc_html__('Link Color','demoTheme'),
					)));

	//Accent Color

	$wp_customize->add_setting('accent_color', array(

						'default'=>'',
						'transport'=>'refresh',
						'sanitize_callback'=>'sanitize_hex_color'
					));
	$wp_customize->add_control(new WP_Customize_Color_Control(

					$wp_customize, 'accent_color',array(

						'section'=>'colors',
						'label'=>esc_html__('Accent Color','demoTheme'),
					)));

	//Border Color

	$wp_customize->add_setting('border_color', array(

						'default'=>'',
						'transport'=>'refresh',
						'sanitize_callback'=>'sanitize_hex_color'
					));
	$wp_customize->add_control(new WP_Customize_Color_Control(

					$wp_customize, 'border_color',array(

						'section'=>'colors',
						'label'=>esc_html__('Border Color','demoTheme'),
					)));
	//Sidebar Background Color

	$wp_customize->add_setting('sidebar_background', array(

						'default'=>'',
						'transport'=>'refresh',
						'sanitize_callback'=>'sanitize_hex_color'
					));
	$wp_customize->add_control(new WP_Customize_Color_Control(

					$wp_customize, 'sidebar_background',array(

						'section'=>'colors',
						'label'=>esc_html__('Sidebar Background','demoTheme'),
					)));

}

add_action('customize_register','theme_customize_register');
	
function theme_get_customizer_css()
{
	ob_start();

	$text_color = get_theme_mod('text_color','');
	if(!empty($text_color))
	{
	


?>

body
{
	color: <?php echo $text_color; ?>
}

<?php
	
	}

$link_color = get_theme_mod('link_color','');

if(!empty($link_color))
	{

?>

a
{
	color: <?php echo $link_color; ?>
	border-bottom-color: <?php echo $link_color; ?>
}

<?php
	
	}
$border_color = get_theme_mod('border_color','');

if(!empty($border_color))
	{

?>

input, textarea
{
	
	border-color: <?php echo $border_color; ?>
}

<?php
	
	}

$accent_color = get_theme_mod('accent_color','');

if(!empty($accent_color))
	{

?>

a:hover
{
	
	color: <?php echo $accent_color; ?>
	border-bottom-color: <?php echo $accent_color; ?>
}

button, input[type="submit"]
{
	background-color: <?php echo $accent_color; ?>
}

<?php
	
	}

$sidebar_background = get_theme_mod('sidebar_background','');

if(!empty($sidebar_background))
	{

?>

.sidebar
{
	
	background-color: <?php echo $sidebar_background; ?>
}

<?php
	
	}

$css = ob_get_clean();

return $css;
}
function theme_enqueue_styles()
{
	wp_enqueue_style('theme-styles',get_stylesheet_uri());

	$custom_css = theme_get_customizer_css();

	wp_add_inline_style('theme-styles', $custom_css);
}

add_action('wp_enqueue_scripts','theme_enqueue_styles');

?>