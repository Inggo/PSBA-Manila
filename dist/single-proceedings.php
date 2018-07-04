<?php

get_header();

$queried_object = get_queried_object();

if (have_posts()) :
while (have_posts()) :
    the_post();
    get_template_part('partials/single/content', 'proceedings');
endwhile;
endif;

get_footer();
