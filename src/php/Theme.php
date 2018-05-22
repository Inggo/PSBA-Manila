<?php

namespace Inggo\WordPress\PSBAManila;

class Theme
{
    public $wp_theme;
    public $version;

    public function __construct()
    {
        $this->wp_theme = wp_get_theme();
        $this->version = $this->wp_theme->get('Version');
    }

    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'registerScriptStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_filter('show_admin_bar', '__return_false');
    }

    public function registerScriptStyles()
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', [], '3.3.1');
        wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], '1.12.9');
        wp_register_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['jquery', 'popper'], '4.0.0');
        wp_register_script('main_js', get_template_directory_uri() . '/script.js', ['bootstrap_js'], $this->version);
    }

    public function enqueueStyles()
    {
        wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css', [], $this->version);
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('main_js');
    }
}
