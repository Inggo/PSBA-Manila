<article class="row">
    <?php if (has_post_thumbnail()): ?>
    <div class="col-4 col-md-3">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('post-thumbnail', ['class' => 'mr-3']); ?>
        </a>
    </div>
    <?php endif; ?>
    <div class="col">
        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <?php the_excerpt(); ?>
    </div>
</article>
