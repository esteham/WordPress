<?php
/**
 * The template for displaying comments
 *
 * @package TravelCloud
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $travelcloud_comment_count = get_comments_number();
            if ('1' === $travelcloud_comment_count) {
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'travelcloud'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $travelcloud_comment_count, 'comments title', 'travelcloud')),
                    number_format_i18n($travelcloud_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'travelcloud'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    comment_form(
        array(
            'title_reply' => esc_html__('Leave a Comment', 'travelcloud'),
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h2>',
        )
    );
    ?>
</div>