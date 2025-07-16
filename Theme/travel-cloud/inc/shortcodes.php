<?php
// Destination Grid Shortcode
function travelcloud_destinations_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 6,
        'type' => '',
    ), $atts);

    $args = array(
        'post_type' => 'destination',
        'posts_per_page' => $atts['count'],
    );

    if (!empty($atts['type'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'destination_type',
                'field' => 'slug',
                'terms' => $atts['type'],
            )
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        echo '<div class="destinations-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="destination-card">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="destination-thumbnail">
                            <?php the_post_thumbnail('travelcloud-card'); ?>
                        </div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
        return ob_get_clean();
    }

    return __('No destinations found', 'travelcloud');
}
add_shortcode('destinations', 'travelcloud_destinations_shortcode');

// Testimonial Slider Shortcode
function travelcloud_testimonials_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 3,
    ), $atts);

    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => $atts['count'],
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        ?>
        <div class="testimonials-slider">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="testimonial">
                    <div class="testimonial-content"><?php the_content(); ?></div>
                    <div class="testimonial-author">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="author-avatar">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <h4><?php the_title(); ?></h4>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <script>
            jQuery(document).ready(function($) {
                $('.testimonials-slider').slick({
                    dots: true,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 5000,
                });
            });
        </script>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

    return __('No testimonials found', 'travelcloud');
}
add_shortcode('testimonials', 'travelcloud_testimonials_shortcode');

// Contact Info Shortcode
function travelcloud_contact_info_shortcode() {
    $options = get_option('travelcloud_options');
    ob_start();
    ?>
    <div class="contact-info-widget">
        <?php if (!empty($options['phone'])) : ?>
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <span><?php echo esc_html($options['phone']); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($options['email'])) : ?>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <span><?php echo esc_html($options['email']); ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($options['address'])) : ?>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span><?php echo nl2br(esc_html($options['address'])); ?></span>
            </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('contact_info', 'travelcloud_contact_info_shortcode');