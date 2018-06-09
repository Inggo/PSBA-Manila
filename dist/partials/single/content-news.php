<article class="row">
    <?php if (has_post_thumbnail()): ?>
    <figure class="col-md-3">
        <?php the_post_thumbnail('post-thumbnail'); ?>
    </figure>
    <?php endif; ?>
    <div class="col">
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
        <aside>
            <p>Published <?php the_date(); ?>, <?php the_time(); ?><br>
                By <?php the_author(); ?></p>
        </aside>
    </div>
</article>
