<?php
if (!function_exists('travelcloud_posted_on')) :
    function travelcloud_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date())
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if (!function_exists('travelcloud_posted_by')) :
    function travelcloud_posted_by() {
        echo '<span class="byline"> by ' . esc_html(get_the_author()) . '</span>';
    }
endif;