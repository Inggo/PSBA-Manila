<?php

global $theme;
global $admin;

// Load Composer autoloader.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

$theme = new Inggo\WordPress\PSBAManila\Theme;
$theme->init();

$admin = new Inggo\WordPress\PSBAManila\Admin;
$admin->init();

// Include pages in search results
is_admin() || add_action('pre_get_posts', function(\WP_Query $query) {
    if ($query->is_main_query() && $query->is_search()) {
        $query->set('post_type', ['post', 'page']);
    }
});
