<?php

global $theme;

$children = get_children([
    'post_parent' => get_the_ID(),
    'post_type' => 'page',
    'post_status' => 'publish',
    'order' => 'ASC',
    'orderby' => 'menu_order'
]);
?>
<h2><?php the_title(); ?></h2>
<section class="container">
    <div class="row justify-content-md-center">
        <div class="col col-md-3">
            <div class="list-group" id="page-tabs" role="tablist" aria-orientation="vertical">
                <?php $i = 0; foreach ($children as $post): setup_postdata($post); ?>
                <a class="list-group-item 
                    <?php if ((!$theme->hasCurrentPost() && $i === 0) || $theme->isCurrentPost($post)): ?>
                        active
                    <?php endif; ?>
                    " id="page-<?= $post->post_name ?>-tab" data-toggle="tab" href="#page-<?= $post->post_name ?>" role="tab" aria-controls="home"
                    aria-selected="<?= ((!$theme->hasCurrentPost() && $index === 0) || $theme->isCurrentPost($post)) ? 'true' : 'false'; ?>"><?php the_title(); ?></a>
                </a>
                <?php $i++; endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
        <div class="col col-md-9">
            <div class="tab-content" id="page-tab-contents">
                <?php $i = 0; foreach ($children as $index => $post): setup_postdata($post); ?>
                <div class="tab-pane fade
                    <?php if ((!$theme->hasCurrentPost() && $i === 0) || $theme->isCurrentPost($post)): ?>
                    active show
                    <?php endif; ?>
                " id="page-<?= $post->post_name ?>" role="tabpanel" aria-labelledby="home-tab">
                <?php get_template_part('partials/content', 'page'); ?>
                </div>
                <?php $i++; endforeach; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
