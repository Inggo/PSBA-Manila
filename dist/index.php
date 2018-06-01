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
    <?php if (!$queried_object && $_GET['s']): ?>
    <h2>Search Results</h2>
    <?php else: ?>
    <h2><?= $queried_object->name ?></h2>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <?php
            if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('partials/single/excerpt', get_the_category() ? get_the_category()[0]->slug : 'default');
            endwhile;
            ?>
        </div>
    </div>
    <nav aria-label="Page Navigation">
        <ul class="pagination justify-content-end">
            <?php if (get_previous_posts_link()): ?>
            <li class="page-item">
                <?= get_previous_posts_link('&laquo; Previous') ?>
            </li>
            <?php endif; ?>
            <?php if (get_next_posts_link()): ?>
            <li class="page-item">
                <?= get_next_posts_link('Next &raquo;') ?>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php
endif;

get_footer();
