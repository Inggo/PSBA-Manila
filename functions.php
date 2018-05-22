<?php

global $theme;

// Load Composer autoloader.
if (file_exists( __DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

$theme = new Inggo\WordPress\PSBAManila\Theme;
$theme->init();
