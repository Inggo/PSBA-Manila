<?php
global $theme;

$subquery = new WP_Query([
    'category_name' => 'news',
    'posts_per_page' => 5,
    'post_status' => 'publish',
]);

if ($subquery->have_posts()) {
    while ($subquery->have_posts()) {
        $subquery->the_post();
        get_template_part('partials/single/excerpt', 'news');
    }
} else {
    $theme->alert('Sorry, no posts matched your criteria.');
}

wp_reset_postdata();

?>
<a class="btn-primary btn float-right" href="/category/news/" role="button">
    News Archives
</a>