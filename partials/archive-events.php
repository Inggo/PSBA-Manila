<?php
$subquery = new WP_Query([
    'category_name' => 'event',
    'posts_per_page' => 5,
    'post_status' => 'publish',
]);

if ($subquery->have_posts()) {
    while ($subquery->have_posts()) {
        $subquery->the_post();
        get_template_part('partials/single/excerpt', 'events');
    }
} else {
    get_template_part('partials/alert', 'empty');
}

wp_reset_postdata();

?>
<a class="btn-primary btn float-right" href="/category/events/" role="button">
    Event Archives
</a>