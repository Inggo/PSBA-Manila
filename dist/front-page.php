<?php
/**
 * Default template
 *
 * @author  Inggo Espinosa <inggo.espinosa@gmail.com>
 * @since   1.0
 */

get_header();

while (have_posts()) {
    the_post();
    get_template_part('partials/front-page/content', 'page');
}

get_footer();
