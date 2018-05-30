<?php
global $post;
?>
<article class="card">
    <?php if (get_post_meta($post->ID, '_wp_page_template', true) != 'templates/multi-content.php'): ?>
    <h2 class="card-header"><?php the_title(); ?></h2>
    <section class="card-body text-justify page-contents">
        <?php the_content(); ?>
    </section>
    <?php else: ?>
    <section class="text-justify page-contents multi-content">
        <?php the_content(); ?>
    </section>
    <?php endif; ?>
</article>
