<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'main_menu',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'main-menu',
        'menu_class'      => 'navbar-nav mr-auto ml-auto',
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker(),
        'depth'           => 1
    ));
    ?>
    <div class="search-form">
        <form class="form-inline my-2 my-lg-0" method="get" action="<?= home_url( '/' ); ?>">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="s" id="s">
        </form>
    </div>
</nav>