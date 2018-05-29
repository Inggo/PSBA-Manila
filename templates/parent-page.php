<?php

/**
 * Template Name: Parent Page
 *
 * @package WordPress
 * @subpackage psba-manila
 */

get_header();

if (have_posts()) :
while (have_posts()) :
    the_post();
    get_template_part('partials/page', 'parent');
    wp_reset_postdata();
endwhile;
endif;

get_footer();
