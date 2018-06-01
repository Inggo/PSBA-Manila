<?php

/**
 * Template Name: Multi-Content Page
 *
 * @package WordPress
 * @subpackage psba-manila
 */

global $theme;
global $post;

get_header();

if (have_posts()) :
while (have_posts()) :
    the_post();

    $theme->setCurrentPost($post);

    if ($post->post_parent):
        $post = get_post($post->post_parent);
        setup_postdata($post);

        get_template_part('partials/page', 'parent');
        wp_reset_postdata();
    endif;
endwhile;
endif;

get_footer();
