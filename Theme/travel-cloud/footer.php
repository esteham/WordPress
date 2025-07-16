<?php
/**
 * The template for displaying the footer
 *
 * @package TravelCloud
 */
?>

    </div><!-- #content -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <nav class="footer-navigation">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_id' => 'footer-menu',
                        'depth' => 1,
                    )
                );
                ?>
            </nav>

            <div class="site-info">
                <p>
                    <?php
                    printf(
                        esc_html__('&copy; %1$s %2$s. All rights reserved.', 'travelcloud'),
                        date('Y'),
                        get_bloginfo('name')
                    );
                    ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>