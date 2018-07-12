<?php

// Load Composer autoloader.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

add_action('after_setup_theme', 'psba_manila_theme_setup', 10);
add_action('after_setup_theme', 'psba_manila_admin_setup', 10);

function psba_manila_theme_setup () {
    global $theme;
    $theme = new Inggo\WordPress\PSBAManila\Theme;
    $theme->init();
}

function psba_manila_admin_setup () {
    global $admin;
    $admin = new Inggo\WordPress\PSBAManila\Admin;
    $admin->init();    
}

// Include pages in search results
is_admin() || add_action('pre_get_posts', function(\WP_Query $query) {
    if ($query->is_main_query() && $query->is_search()) {
        $query->set('post_type', ['post', 'page']);
    }
});
