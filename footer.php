</main>
<footer class="site-footer">
    <section class="container">
        <div class="row">
            <nav class="footer-nav col-md-8">
                <?php
                wp_nav_menu( array(
                    'theme_location'  => 'footer_menu',
                    'container'       => 'div'
                ) );
                ?>
            </nav>
            <div class="col-md-4">
                
            </div>
        </div>
    </section>
    <section class="site-copyright text-center">
        <p><?= get_option('copyright'); ?></p>
    </section>
</footer>
<?php
wp_footer();
?>
<div id="outdated"></div>
</body>
</html>