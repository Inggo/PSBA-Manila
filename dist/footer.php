</main>
<footer class="site-footer">
    <section class="container">
        <div class="row">
            <?php dynamic_sidebar("Footer Widgets - Left"); ?>
            <?php dynamic_sidebar("Footer Widgets - Center"); ?>
            <?php dynamic_sidebar("Footer Widgets - Right"); ?>
        </div>
    </section>
    <section class="site-copyright text-center">
        <p><?= nl2br(get_option('copyright')); ?></p>
    </section>
</footer>
<?php get_template_part('partials/pswp'); ?>
<a class="back-to-top" href="javascript:;">
    <span class="btt-caret">^</span>
</a>
<?php
wp_footer();
?>
<div id="outdated"></div>
</body>
</html>