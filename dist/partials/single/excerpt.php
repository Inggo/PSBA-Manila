<article class="row excerpt">
    <div class="col-3 col-md-2">
        <a href="<?php the_permalink(); ?>" class="a-img">
            <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('post-thumbnail', ['class' => 'mr-3']); ?>
            <?php else: ?>
            <img src="<?= get_option('header_logo'); ?>" alt="">
            <?php endif; ?>
        </a>
    </div>ss
    <div class="col">
        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <?php the_excerpt(); ?>
        <aside>
            <p>Published <?php the_date(); ?>, <?php the_time(); ?><br>
                By <?php the_author(); ?></p>
        </aside>
    </div>
</article>
