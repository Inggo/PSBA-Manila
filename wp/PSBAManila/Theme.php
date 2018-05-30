<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Theme as BaseTheme;
use Inggo\WordPress\PSBAManila\CPTRegistrar;

class Theme extends BaseTheme
{
    public function __construct()
    {
        parent::__construct('psba-manila', new ThemeCustomizer);
        $this->cpt_registrar[] = new CPTRegistrar;
    }

    public function registerScriptStyles()
    {
        parent::registerScriptStyles();

        wp_register_style('google-webfonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,700', [], '');
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', ['google-webfonts', 'bootstrap_css'], $this->version);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('main_js');
    }

    protected function addImageSizes()
    {
        add_image_size('psba-small', 240, 240);
        add_image_size('psba-medium', 480, 480);
        add_image_size('psba-large', 960, 960);
    }
}
