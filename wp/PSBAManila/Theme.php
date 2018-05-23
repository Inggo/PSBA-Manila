<?php

namespace Inggo\WordPress\PSBAManila;

use Inggo\WordPress\Theme as BaseTheme;

class Theme extends BaseTheme
{
    public function __construct()
    {
        parent::__construct('psba-manila', new ThemeCustomizer);
    }

    public function registerScriptStyles()
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', [], '3.3.1');
        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], '1.12.9');
        wp_register_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['jquery', 'popper'], '4.0.0');
        wp_register_script('main_js', get_template_directory_uri() . '/script.js', ['bootstrap_js'], $this->version);

        wp_register_style('google-webfonts', 'https://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,700', [], '');
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', ['google-webfonts'], $this->version);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('main_js');
    }
}
