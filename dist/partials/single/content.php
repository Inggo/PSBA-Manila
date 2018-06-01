<article class="row">
    <div class="col">
        <h3><?php the_title(); ?></h3>
        <?php if (has_post_thumbnail()): ?>
        <figure>
            <?php the_post_thumbnail('post-thumbnail'); ?>
        </figure>
        <?php endif; ?>
        <?php the_content(); ?>
    </div>
</article>
