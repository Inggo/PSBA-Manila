<?php

$title = get_post_meta($post->ID, 'page_title', true);

?>
<h2><?= $title ? $title : get_the_title(); ?></h2>
<section class="container">
    <div class="row">
        <article class="col col-12">
            <?php the_content(); ?>
            <p></p>
            <p class="text-right"><button type="button" class="btn btn-primary btn-lg" onclick="javascript:history.go(-1)">&laquo; Back</button></p>
        </article>
    </div>
</section>