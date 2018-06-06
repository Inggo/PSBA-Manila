<?php
global $theme;

$subquery = new WP_Query([
    'name'        => 'partners-and-linkages',
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
]);

if ($subquery->have_posts()) {
    while ($subquery->have_posts()) {
        $subquery->the_post();
        the_content();
    }
}

wp_reset_postdata();
