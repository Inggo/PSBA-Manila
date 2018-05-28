<?php

namespace Inggo\WordPress;

use Inggo\WordPress\Traits\DisplaysMessages;
use Inggo\WordPress\Contracts\Customizer;

class Theme
{
    use DisplaysMessages;

    public $customizer;

    public $admin;

    public $theme_data;
    public $version;
    public $slug = '';

    public function __construct($slug = 'theme', Customizer $customizer)
    {
        $this->slug = $slug;
        $this->customizer = $customizer;
        $this->theme_data = wp_get_theme();
        $this->version = $this->theme_data->get('Version');
    }

    public function init()
    {
        // Add theme hooks
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('after_setup_theme', [$this, 'disableAdminBar']);
        
        add_action('wp_enqueue_scripts', [$this, 'registerScriptStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        add_action('customize_register', [$this->customizer, 'register']);

        add_filter('pre_get_posts', [$this, 'searchFilter']);
    }

    public function disableAdminBar()
    {
        show_admin_bar(false);
    }

    public function searchFilter($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
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

    /**
     * Set-up the theme features
     */
    public function setup()
    {
        // Add thumbnail support
        add_theme_support('post-thumbnails');

        // Set the thumbnail size
        set_post_thumbnail_size(420, 280);

        // Add custom image sizes
        $this->addImageSizes();
        
        // Add menus support
        add_theme_support('menus');

        // Register the nav menus
        register_nav_menus(array(
            'main_menu' => 'Main Menu',
        ));

        // Add widgets support
        add_theme_support('widgets');
    }

    protected function addImageSizes()
    {
        return;
    }
}
