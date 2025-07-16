<?php
/**
 * User dashboard template part
 *
 * @package TravelCloud
 */

if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}
?>

<div class="user-dashboard">
    <div class="dashboard-header">
        <h2><?php esc_html_e('Welcome to Your Dashboard', 'travelcloud'); ?></h2>
        <p><?php esc_html_e('Manage your travel bookings and profile', 'travelcloud'); ?></p>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-sidebar">
            <ul class="dashboard-menu">
                <li class="active"><a href="#profile"><?php esc_html_e('Profile', 'travelcloud'); ?></a></li>
                <li><a href="#bookings"><?php esc_html_e('Bookings', 'travelcloud'); ?></a></li>
                <li><a href="#wishlist"><?php esc_html_e('Wishlist', 'travelcloud'); ?></a></li>
                <li><a href="#reviews"><?php esc_html_e('Reviews', 'travelcloud'); ?></a></li>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Logout', 'travelcloud'); ?></a></li>
            </ul>
        </div>

        <div class="dashboard-main">
            <div id="profile" class="dashboard-section">
                <h3><?php esc_html_e('Your Profile', 'travelcloud'); ?></h3>
                <?php
                $current_user = wp_get_current_user();
                ?>
                <div class="profile-info">
                    <div class="profile-avatar">
                        <?php echo get_avatar($current_user->ID, 120); ?>
                    </div>
                    <div class="profile-details">
                        <p><strong><?php esc_html_e('Name:', 'travelcloud'); ?></strong> <?php echo esc_html($current_user->display_name); ?></p>
                        <p><strong><?php esc_html_e('Email:', 'travelcloud'); ?></strong> <?php echo esc_html($current_user->user_email); ?></p>
                        <p><strong><?php esc_html_e('Member since:', 'travelcloud'); ?></strong> <?php echo date_i18n(get_option('date_format'), strtotime($current_user->user_registered)); ?></p>
                    </div>
                </div>
            </div>

            <div id="bookings" class="dashboard-section" style="display:none;">
                <h3><?php esc_html_e('Your Bookings', 'travelcloud'); ?></h3>
                <p><?php esc_html_e('You have no bookings yet.', 'travelcloud'); ?></p>
            </div>

            <div id="wishlist" class="dashboard-section" style="display:none;">
                <h3><?php esc_html_e('Your Wishlist', 'travelcloud'); ?></h3>
                <p><?php esc_html_e('You have no items in your wishlist yet.', 'travelcloud'); ?></p>
            </div>

            <div id="reviews" class="dashboard-section" style="display:none;">
                <h3><?php esc_html_e('Your Reviews', 'travelcloud'); ?></h3>
                <p><?php esc_html_e('You have not submitted any reviews yet.', 'travelcloud'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('.dashboard-menu a').click(function(e) {
        e.preventDefault();
        
        // Update active menu item
        $('.dashboard-menu li').removeClass('active');
        $(this).parent().addClass('active');
        
        // Show selected section
        var target = $(this).attr('href');
        $('.dashboard-section').hide();
        $(target).show();
    });
});
</script>