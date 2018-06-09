<?php
/**
 * Default template
 *
 * @author  Inggo Espinosa <inggo.espinosa@gmail.com>
 * @since   1.0
 */

get_header();

$queried_object = get_queried_object();

?>
<section class="container">
    <div class="row">
        <div class="col-12">
            <?php
            if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('partials/single/content', get_the_category() ? get_the_category()[0]->slug : 'default');
            endwhile;
            ?>
        </div>
    </div>
</div>
<?php
endif;

get_footer();
