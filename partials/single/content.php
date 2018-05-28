<article class="row">
    <div class="col">
        <h2><?php the_title(); ?></h2>    
        <?php if (has_post_thumbnail()): ?>
        <figure>
            <?php the_post_thumbnail('post-thumbnail'); ?>
        </figure>
        <?php endif; ?>
        <?php the_content(); ?>
    </div>
</article>
